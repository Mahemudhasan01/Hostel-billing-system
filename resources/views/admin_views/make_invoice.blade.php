<?php 

include_once('includes/config.php');


if ($action == 'create_invoice'){

// var_dump($action); die;
// invoice customer information
// billing
$customer_name = $_POST['customer_name']; // customer name
$customer_email = $_POST['customer_email']; // customer email
$customer_address_1 = $_POST['customer_address_1']; // customer address
$customer_town = $_POST['customer_town']; // customer town
// $customer_county = $_POST['customer_county']; // customer county
$customer_postcode = $_POST['customer_postcode']; // customer postcode
$customer_phone = $_POST['customer_phone']; // customer phone number

//shipping
// $customer_name_ship = $_POST['customer_name_ship']; // customer name (shipping)
// $customer_address_1_ship = $_POST['customer_address_1_ship']; // customer address (shipping)
// $customer_address_2_ship = $_POST['customer_address_2_ship']; // customer address (shipping)
// $customer_town_ship = $_POST['customer_town_ship']; // customer town (shipping)
// $customer_county_ship = $_POST['customer_county_ship']; // customer county (shipping)
// $customer_postcode_ship = $_POST['customer_postcode_ship']; // customer postcode (shipping)

// invoice details
$invoice_number = $_POST['invoice_id']; // invoice number
$custom_email = $_POST['custom_email']; // invoice custom email body
$month = $_POST['month']; // invoice Month
$custom_email = $_POST['custom_email']; // custom invoice email
$year = $_POST['year']; // invoice due date
$invoice_subtotal = $_POST['invoice_subtotal']; // invoice sub-total
$invoice_shipping = $_POST['invoice_shipping']; // invoice shipping amount
$invoice_discount = $_POST['invoice_discount']; // invoice discount
$invoice_vat = $_POST['invoice_vat']; // invoice vat
$invoice_total = $_POST['invoice_total']; // invoice total
$invoice_notes = $_POST['invoice_notes']; // Invoice notes
$invoice_type = $_POST['invoice_type']; // Invoice type
$invoice_status = $_POST['invoice_status']; // Invoice status

// insert invoice into database
$query = "INSERT INTO invoices (
                invoice,
                custom_email,
                month, 
                year, 
                subtotal, 
                shipping, 
                discount, 
                vat, 
                total,
                notes,
                invoice_type,
                status
            ) VALUES (
                  '".$invoice_number."',
                  '".$custom_email."',
                  '".$month."',
                  '".$year."',
                  '".$invoice_subtotal."',
                  '".$invoice_shipping."',
                  '".$invoice_discount."',
                  '".$invoice_vat."',
                  '".$invoice_total."',
                  '".$invoice_notes."',
                  '".$invoice_type."',
                  '".$invoice_status."'
            );
        ";
// insert customer details into database
$query .= "INSERT INTO customers (
                invoice,
                name,
                email,
                address_1,
                address_2,
                town,
                county,
                postcode,
                phone,
                
            ) VALUES (
                '".$invoice_number."',
                '".$customer_name."',
                '".$customer_email."',
                '".$customer_address_1."',
                'Null',
                '".$customer_town."',
                'Null',
                '".$customer_postcode."',
                '".$customer_phone."',
            );
        ";

// invoice product items
foreach($_POST['invoice_product'] as $key => $value) {
    $item_product = $value;
    // $item_description = $_POST['invoice_product_desc'][$key];
    $item_qty = $_POST['invoice_product_qty'][$key];
    $item_price = $_POST['invoice_product_price'][$key];
    $item_discount = $_POST['invoice_product_discount'][$key];
    $item_subtotal = $_POST['invoice_product_sub'][$key];

    // insert invoice items into database
    $query .= "INSERT INTO invoice_items (
            invoice,
            product,
            qty,
            price,
            discount,
            subtotal
        ) VALUES (
            '".$invoice_number."',
            '".$item_product."',
            '".$item_qty."',
            '".$item_price."',
            '".$item_discount."',
            '".$item_subtotal."'
        );
    ";

}

header('Content-Type: application/json');

// execute the query
if($mysqli -> multi_query($query)){
    //if saving success
    echo json_encode(array(
        'status' => 'Success',
        'message' => 'Invoice has been created successfully!'
    ));

    //Set default date timezone
    date_default_timezone_set(TIMEZONE);
    //Include Invoicr class
    include('invoice.php');
    //Create a new instance
    $invoice = new invoicr("A4",CURRENCY,"en");
    //Set number formatting
    $invoice->setNumberFormat('.',',');
    //Set your logo
    $invoice->setLogo(COMPANY_LOGO,COMPANY_LOGO_WIDTH,COMPANY_LOGO_HEIGHT);
    //Set theme color
    $invoice->setColor(INVOICE_THEME);
    //Set type
    $invoice->setType($invoice_type);
    //Set reference
    $invoice->setReference($invoice_number);
    //Set date
    $invoice->setDate($month);
    //Set due date
    $invoice->setDue($year);
    //Set from
    $invoice->setFrom(array(COMPANY_NAME,COMPANY_ADDRESS_1,COMPANY_ADDRESS_2,COMPANY_COUNTY,COMPANY_POSTCODE,COMPANY_NUMBER,COMPANY_VAT));
    //Set to
    $invoice->setTo(array($customer_name,$customer_address_1,$customer_address_2,$customer_town,$customer_county,$customer_postcode,"Phone: ".$customer_phone));
    //Ship to
    $invoice->shipTo(array($customer_name_ship,$customer_address_1_ship,$customer_address_2_ship,$customer_town_ship,$customer_county_ship,$customer_postcode_ship,''));
    //Add items
    // invoice product items
    foreach($_POST['invoice_product'] as $key => $value) {
        $item_product = $value;
        // $item_description = $_POST['invoice_product_desc'][$key];
        $item_qty = $_POST['invoice_product_qty'][$key];
        $item_price = $_POST['invoice_product_price'][$key];
        $item_discount = $_POST['invoice_product_discount'][$key];
        $item_subtotal = $_POST['invoice_product_sub'][$key];

           if(ENABLE_VAT == true) {
               $item_vat = (VAT_RATE / 100) * $item_subtotal;
           }

        $invoice->addItem($item_product,'',$item_qty,$item_vat,$item_price,$item_discount,$item_subtotal);
    }
    //Add totals
    $invoice->addTotal("Total",$invoice_subtotal);
    if(!empty($invoice_discount)) {
        $invoice->addTotal("Discount",$invoice_discount);
    }
    if(!empty($invoice_shipping)) {
        $invoice->addTotal("Delivery",$invoice_shipping);
    }
    if(ENABLE_VAT == true) {
        $invoice->addTotal("TAX/VAT ".VAT_RATE."%",$invoice_vat);
    }
    $invoice->addTotal("Total Due",$invoice_total,true);
    //Add Badge
    $invoice->addBadge($invoice_status);
    // Customer notes:
    if(!empty($invoice_notes)) {
        $invoice->addTitle("Customer Notes");
        $invoice->addParagraph($invoice_notes);
    }
    //Add Title
    $invoice->addTitle("Payment information");
    //Add Paragraph
    $invoice->addParagraph(PAYMENT_DETAILS);
    //Set footer note
    $invoice->setFooternote(FOOTER_NOTE);
    //Render the PDF
    $invoice->render('invoices/'.$invoice_number.'.pdf','F');
} else {
    // if unable to create invoice
    echo json_encode(array(
        'status' => 'Error',
        'message' => 'There has been an error, please try again.'
        // debug
        //'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
    ));
}

//close database connection
$mysqli->close();

}
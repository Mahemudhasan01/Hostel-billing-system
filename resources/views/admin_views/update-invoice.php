<?php
include_once("includes/config.php");

    // $customer_name = $row['name']; // customer name
    // $customer_email = $row['email']; // customer email
    // $customer_address_1 = $row['address_1']; // customer address
    // $customer_address_2 = $row['address_2']; // customer address
    // $customer_town = $row['town']; // customer town
    // $customer_county = $row['county']; // customer county
    // $customer_postcode = $row['postcode']; // customer postcode
    // $customer_phone = $row['phone']; // customer phone number
    
    // //shipping
    // $customer_name_ship = $row['name_ship']; // customer name (shipping)
    // $customer_address_1_ship = $row['address_1_ship']; // customer address (shipping)
    // $customer_address_2_ship = $row['address_2_ship']; // customer address (shipping)
    // $customer_town_ship = $row['town_ship']; // customer town (shipping)
    // $customer_county_ship = $row['county_ship']; // customer county (shipping)
    // $customer_postcode_ship = $row['postcode_ship']; // customer postcode (shipping)

    // invoice details
	// $invoice_number = $_POST['invoice']; // invoice number
    $invoice_id = $_POST['invoice_id'];
	$custom_email = $_POST['custom_email']; // invoice custom email body
	$month = $_POST['month']; // invoice date
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
    // print_r('".$invoice_id."');die
	$query = "UPDATE invoices SET 
        invoice = '".$invoice_id."',
        custom_email = '".$custom_email."',
        month = '".$month."',
        year = '".$year."',
        subtotal  = '".$invoice_subtotal."',
        shipping  = '".$invoice_shipping."',
        discount  = '".$invoice_discount."',
        vat = '".$invoice_vat."',
        total = '".$invoice_total."',
        notes = '".$invoice_notes."',
        invoice_type = '".$invoice_type."',
        status = '".$invoice_status."'
        WHERE invoice = $invoice_id ";

$result = $mysqli->query($query);
// print_r($result);
header("localhost/InvoiceMg-PHP/invoice-list.php");

// // insert customer details into database
// $query .= "INSERT INTO customers (
//         invoice,
//         name,
//         email,
//         address_1,
//         address_2,
//         town,
//         county,
//         postcode,
//         phone,
//         name_ship,
//         address_1_ship,
//         address_2_ship,
//         town_ship,
//         county_ship,
//         postcode_ship
//     ) VALUES (
//         '".$invoice_number."',
//         '".$customer_name."',
//         '".$customer_email."',
//         '".$customer_address_1."',
//         '".$customer_address_2."',
//         '".$customer_town."',
//         '".$customer_county."',
//         '".$customer_postcode."',
//         '".$customer_phone."',
//         '".$customer_name_ship."',
//         '".$customer_address_1_ship."',
//         '".$customer_address_2_ship."',
//         '".$customer_town_ship."',
//         '".$customer_county_ship."',
//         '".$customer_postcode_ship."'
//     );
// ";

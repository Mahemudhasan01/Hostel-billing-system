<?php


include('header.php');
include('functions.php');

// // Connect to the database
// $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

// // output any connection error
// if ($mysqli->connect_error) {
//     die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
// }

// if (isset($_POST['btn-submit'])) { //check if form was submitted
//     $month = $_POST['month']; //get input text
//     $year = $_POST['year']; //get input text
//     $endMonth = $_POST['endMonth']; //get input text
//     // $endYear = $_POST['endYear']; //get input text

//     // the query
//     $query = "SELECT * 
// 		FROM invoices i
// 		JOIN customers c
// 		ON c.invoice = i.invoice
// 		WHERE i.invoice = c.invoice AND invoice_date >= '01-02-2023'
// 		-- WHERE i.invoice = c.invoice AND invoice_date = '01/$month/$year' AND invoice_due_date = '30/$endMonth/$year'
// 		ORDER BY c.invoice";

//     // var_dump($query);
//     // die;
//     // mysqli select query
//     $results = $mysqli->query($query);

//     foreach ($results as $row) {
?>


<h1>Find Receipts</h1>
<hr>

<div class="row">

    <div class="col-xs-12">

        <div id="response" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Manage Invoices</h4>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                    <!-- Start date -->

                    <div class="select-date form-select">
                        <select id="select-month" name="month">
                            <option value="01">January
                            <option value="02">February
                            <option value="03">March
                            <option value="04">April
                            <option value="05">May
                            <option value="06">June
                            <option value="07">July
                            <option value="08">August
                            <option value="09">September
                            <option value="10">October
                            <option value="11">November
                            <option value="12">December
                        </select>
                        <select id="select-year" name="year">
                            <option value="2023">2023
                            <option value="2022">2022
                            <option value="2023">2023
                            <option value="2024">2024
                            <option value="2025">2025
                        </select>
                    </div>

                    <!-- End date -->
                    <div class="select-date form-select">
                        <select id="select-month" name="endMonth">
                            <option value="1">January
                            <option value="2">February
                            <option value="3">March
                            <option value="4">April
                            <option value="5">May
                            <option value="6">June
                            <option value="7">July
                            <option value="8">August
                            <option value="9">September
                            <option value="10">October
                            <option value="11">November
                            <option value="12">December
                        </select>
                        <select id="select-year" name="endYear">
                            <option value="2023">2023
                            <option value="2022">2022
                            <option value="2023">2023
                            <option value="2024">2024
                            <option value="2025">2025
                        </select>
                    </div>
                    <input type="submit" name="btn-submit" value="Submit">
            </div>
            </form>

            <div class="panel-body form-group form-group-sm">
                <?php if (isset($_POST['btn-submit'])) { //check if form was submitted 
                    getResults();
                }
                ?>
            </div>
        </div>
    </div>
    <div>

        <div id="delete_invoice" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Invoice</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this invoice?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php
        include('footer.php');
        ?>
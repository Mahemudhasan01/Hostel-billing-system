<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">

                    <table>
                        <tr>
                            <td class="title">
                                {{-- public_path()."/logo/Darga-Logo.jpg" }} --}}
                                <img src="{{ public_path()."/logo/Darga-Logo.jpg" }}"
                                    style="width: 150px; height: 150px; border-radius: 50%"; />
                            </td>

                            <td>
                                <b>Receipt #:</b> {{ $receipt }} <br />
                                <b>Created:</b> {{ $data }} <br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h3 style="margin-top: 0%; margin-bottom:0%">From:</h3>
                                Mashayak Hostel<br />
                                Chartoda Kabrastan, Anil Starch Mill Rd<br />
                                Ahmedabad, Gujarat 380002
                            </td>

                            <td>
                                <h3 style="margin-top: 0%; margin-bottom:0%">To:</h3>
                                {{ $name }}.<br />
                                {{ $villege }},<br />
                                {{ $district }},<br />
                                {{ $phone }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            {{-- <tr class="heading">
                <td>Payment Method</td>

                <td>Check #</td>
            </tr>

            <tr class="details">
                <td>Check</td>

                <td>1000</td>
            </tr> --}}
        </table>
            <table>
                <tr class="heading">
                    <td>Room No.</td>
                    <td style="text-align: center">Month From.</td>
                    <td style="text-align: center">Month To.</td>
                    <td style="text-align: center">Total Months.</td>
                    <td style="text-align: center">Price(Rs.)</td>
                </tr>


                <tr class="item">
                    <td>{{ $room_no }}</td>
                    <td style="text-align: center">@php
                        if ($start_month == '1') {
                            echo 'Jan';
                        } elseif ($start_month == '2') {
                            # code...
                            echo 'Feb';
                        } elseif ($start_month == '3') {
                            # code...
                            echo 'March';
                        } elseif ($start_month == '4') {
                            # code...
                            echo 'April';
                        } elseif ($start_month == '5') {
                            # code...
                            echo 'May';
                        } elseif ($start_month == '6') {
                            # code...
                            echo 'Jun';
                        } elseif ($start_month == '7') {
                            # code...
                            echo 'July';
                        } elseif ($start_month == '8') {
                            # code...
                            echo 'Aug';
                        } elseif ($start_month == '9') {
                            # code...
                            echo 'Sep';
                        } elseif ($start_month == '10') {
                            # code...
                            echo 'Oct';
                        } elseif ($start_month == '11') {
                            # code...
                            echo 'Nov';
                        } elseif ($start_month == '12') {
                            # code...
                            echo 'Dec';
                        }@endphp</td>
                    <td style="text-align: center">@php
                        if ($end_month == '1') {
                            echo 'Jan';
                        } elseif ($end_month == '2') {
                            # code...
                            echo 'Feb';
                        } elseif ($end_month == '3') {
                            # code...
                            echo 'March';
                        } elseif ($end_month == '4') {
                            # code...
                            echo 'April';
                        } elseif ($end_month == '5') {
                            # code...
                            echo 'May';
                        } elseif ($end_month == '6') {
                            # code...
                            echo 'Jun';
                        } elseif ($end_month == '7') {
                            # code...
                            echo 'July';
                        } elseif ($end_month == '8') {
                            # code...
                            echo 'Aug';
                        } elseif ($end_month == '9') {
                            # code...
                            echo 'Sep';
                        } elseif ($end_month == '10') {
                            # code...
                            echo 'Oct';
                        } elseif ($end_month == '11') {
                            # code...
                            echo 'Nov';
                        } elseif ($end_month == '12') {
                            # code...
                            echo 'Dec';
                        }@endphp</td>
                    <td style="text-align: center"> {{$total_month}} </td>
                    <td style="text-align: center">{{ $fees }}</td>
                </tr>



                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: center"><b>Total: {{ $total_paid }}/- </b></td>
                </tr>
        </table>

    </div>
</body>

</html>

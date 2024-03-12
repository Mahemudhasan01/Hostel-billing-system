@extends('dashboard_layouts.main')

@section('main-container')
    <h1>Receipt List</h1>
    <hr>

    <div class="row">

        <div class="col-xs-12">

            <div id="response" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Manage Employee Receipts</h4>
                </div>
                <div class="panel-body form-group form-group-sm">
                    <table class="table table-striped table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Receipt No.</th>
                                <th>Employee Name</th>
                                <th>Start Month</th>
                                <th>End Month</th>
                                <th>Total Fees</th>
                                <th>Villege</th>
                                <th>Room</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->receipt }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>@php
                                        if ($item->start_month == '1') {
                                            echo 'Jan';
                                        } elseif ($item->start_month == '2') {
                                            # code...
                                            echo 'Feb';
                                        } elseif ($item->start_month == '3') {
                                            # code...
                                            echo 'March';
                                        } elseif ($item->start_month == '4') {
                                            # code...
                                            echo 'April';
                                        } elseif ($item->start_month == '5') {
                                            # code...
                                            echo 'May';
                                        } elseif ($item->start_month == '6') {
                                            # code...
                                            echo 'Jun';
                                        } elseif ($item->start_month == '7') {
                                            # code...
                                            echo 'July';
                                        } elseif ($item->start_month == '8') {
                                            # code...
                                            echo 'Aug';
                                        } elseif ($item->start_month == '9') {
                                            # code...
                                            echo 'Sep';
                                        } elseif ($item->start_month == '10') {
                                            # code...
                                            echo 'Oct';
                                        } elseif ($item->start_month == '11') {
                                            # code...
                                            echo 'Nov';
                                        } elseif ($item->start_month == '12') {
                                            # code...
                                            echo 'Dec';
                                        }
                                    @endphp</td>
                                    <td>
                                        @php
                                            if ($item->end_month == '1') {
                                                echo 'Jan';
                                            } elseif ($item->end_month == '2') {
                                                # code...
                                                echo 'Feb';
                                            } elseif ($item->end_month == '3') {
                                                # code...
                                                echo 'March';
                                            } elseif ($item->end_month == '4') {
                                                # code...
                                                echo 'April';
                                            } elseif ($item->end_month == '5') {
                                                # code...
                                                echo 'May';
                                            } elseif ($item->end_month == '6') {
                                                # code...
                                                echo 'Jun';
                                            } elseif ($item->end_month == '7') {
                                                # code...
                                                echo 'July';
                                            } elseif ($item->end_month == '8') {
                                                # code...
                                                echo 'Aug';
                                            } elseif ($item->end_month == '9') {
                                                # code...
                                                echo 'Sep';
                                            } elseif ($item->end_month == '10') {
                                                # code...
                                                echo 'Oct';
                                            } elseif ($item->end_month == '11') {
                                                # code...
                                                echo 'Nov';
                                            } elseif ($item->end_month == '12') {
                                                # code...
                                                echo 'Dec';
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ "M-$item->total_months * ₹$item->fees = ". $item->total_months * $item->fees }}</td>
                                    <td>{{ $item->villege }}</td>
                                    <td>{{ $item->room_no }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td><a href="" class="btn btn-primary btn-xs"><span
                                                class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                        <a data-customer-id="" class="btn btn-danger btn-xs delete-customer">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>

            <div id="delete_invoice" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete Invoice</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this invoice?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-primary"
                                id="delete">Delete</button>
                            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endsection

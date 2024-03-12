@extends('dashboard_layouts.main')

@section('main-container')
    <h1>Student List</h1>
    <hr>

    <div class="row">

        <div class="col-xs-12">
            <div id="response" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Number of Students is: <b> {{ $count }} </b></h4>
                </div>
                <div class="panel-body form-group form-group-sm">
                    <table class="table table-striped table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>

                                <th>No.</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Villege</th>
                                <th>Taluko</th>
                                <th>College Name</th>
                                <th>Number</th>
                                <th>Parents Number</th>
                                <th>Joinin Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    {{-- <td> <img src="{{  url($item->photo) }}" alt="" height="30px" width="30px"> </td> --}}
                                    <td>
                                        <img src="{{ asset($item->photo) }}"
                                            style="width: 100px; height: 100px; border-radius: %"; />
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->villege }}</td>
                                    <td>{{ $item->town }}</td>
                                    <td>{{ $item->college_name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->father_phone }}</td>
                                    <td>{{ $item->joining_date }}</td>
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

            <div id="delete_student" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete student</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this student?</p>
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

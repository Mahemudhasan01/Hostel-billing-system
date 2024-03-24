@extends('dashboard_layouts.main')

@section('main-container')
    <h1>Room List</h1>
    <hr>

    <div class="row">

        <div class="col-xs-12">

            <div id="response" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>

            @if(session('success'))
                <div id="success-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div id="error-message" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Room Information</h4>
                </div>
                <div class="panel-body form-group form-group-sm">
                    <table class="table table-striped table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>

                                <th>No.</th>
                                <th>Room Number</th>
                                <th>Room Description</th>
                                <th>Room Fees</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($rooms as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->room }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->fees }}</td>
                                    <td><a href="{{route('edit.room', $item->id)}}" class="btn btn-primary btn-xs"><span
                                                class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                        <a href="{{route('delete.room', $item->id)}}" onclick="return confirmDelete('{{ $item->id }}', 'Room')" class="btn btn-danger btn-xs">
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

            <div id="confirm" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete Room</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Room?</p>
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
        <script>
             
        </script>

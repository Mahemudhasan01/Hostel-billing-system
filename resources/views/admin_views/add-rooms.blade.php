@extends('dashboard_layouts.main')

@section('main-container')
    <h2>Add Room</h2>
    <hr>

    <div id="response" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="message"></div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Room Information</h4>
                </div>
                <div class="panel-body form-group form-group-sm">
                    <form method="post" action="{{ route('add.room') }}" id="add_product">
                        @csrf
                        <input type="hidden" name="action" value="add_product">

                        <div class="row">
                            <div class="col-xs-4">
                                <input type="text" class="form-control required" name="room_name"
                                    placeholder="Enter Room Number">
                                @if ($errors->has('room_name'))
                                    <span class="text-danger mt-0">{{ $errors->first('room_name') }}</span>
                                @endif
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="room_desc"
                                    placeholder="Enter Room Description">

                            </div>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="number" name="room_fees" class="form-control required" placeholder="0.00"
                                        aria-describedby="sizing-addon1">
                                    @if ($errors->has('room_fees'))
                                        <span class="text-danger mt-0">{{ $errors->first('room_fees') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 margin-top btn-group">
                                {{-- id="action_add_product" --}}
                                <input type="submit" id="action_add_product" class="btn btn-success float-right"
                                    value="Add Room" data-loading-text="Adding...">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
        @endsection

@extends('dashboard_layouts.main')

@section('main-container')
    <h2>Create New <span class="invoice_type">Invoice</span> </h2>
    <!-- <hr> -->
    @isset($sucess)
        {{ $sucess }}
    @endisset

    <div id="response" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="message"></div>
    </div>

    <form method="post" action="{{ route('insert.new.receipt') }}">
        @csrf
        <input type="hidden" name="action" value="create_invoice">

        <div class="row">
            <div class="col-xs-4">

            </div>
            <div class="col-xs-8 text-right">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-2 no-padding-right">
                    <div class="form-group">
                        <div class="input-group date" id="invoice_date">
                            <select class="form-control required" name="start_month" placeholder="Invoice Date"
                                data-date-format="">
                                <option value="">Start</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">Octomber</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            @if ($errors->has('start_month'))
                                <span class="text-danger mt-0">{{ $errors->first('start_month') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <div class="input-group date" id="invoice_due_date">
                            <select class="form-control required" name="end_month" placeholder="Due Date"
                                data-date-format="">
                                <option value="">End</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">Octomber</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            @if ($errors->has('end_month'))
                                <span class="text-danger mt-0">{{ $errors->first('end_month') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="input-group col-xs-4 float-right">
                    <span class="input-group-addon">#</span>
                    <input type="text" name="invoice_id" id="invoice_id" class="form-control required"
                        placeholder="Receipt Number" value="{{ $receiptNumber }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="float-left">Student Information</h4>
                        <a href="#" class="float-right select-customer"><b>OR</b> Select Existing Student</a>
                        <div class="clear"></div>

                    </div>
                    <div class="panel-body form-group form-group-sm">
                        <div class="row">
                            <div class="col-xs-6">

                                <div class="form-group">
                                    <input type="hidden" name="student_id" id="customer_id" value="">
                                    <input type="text" class="form-control copy-input required" name="student_name"
                                        id="customer_name" placeholder="Enter Name" tabindex="1">
                                    @if ($errors->has('student_name'))
                                        <span class="text-danger mt-0">{{ $errors->first('student_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="villege"
                                        id="customer_address_1" placeholder="Villege" tabindex="3">
                                    @if ($errors->has('villege'))
                                        <span class="text-danger mt-0">{{ $errors->first('villege') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control  copy-input required" name="district"
                                        id="customer_town" placeholder="District" tabindex="5">
                                    @if ($errors->has('district'))
                                        <span class="text-danger mt-0">{{ $errors->first('district') }}</span>
                                    @endif
                                </div>
                                <div class="form-group no-margin-bottom">
                                    <input type="text" class="form-control copy-input required" name="postcode"
                                        id="customer_postcode" placeholder="Postcode" tabindex="7">
                                    @if ($errors->has('postcode'))
                                        <span class="text-danger mt-0">{{ $errors->first('postcode') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6">
                                {{-- <div class="input-group float-right ">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control copy-input margin-bottom required"
                                        name="email" id="customer_email" placeholder="E-mail Address"
                                        aria-describedby="sizing-addon1" tabindex="2">
                                    @if ($errors->has('email'))
                                        <span class="text-danger mt-0">{{ $errors->first('email') }}</span>
                                    @endif
                                </div> --}}
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input " name="status"
                                        id="customer_address_2" placeholder="Status" tabindex="4">
                                    @if ($errors->has('status'))
                                        <span class="text-danger mt-0">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="student_county" id="customer_county" placeholder="Country" tabindex="6">
							</div> --}}
                                <div class="form-group no-margin-bottom">
                                    <input type="text" class="form-control required" name="phone"
                                        id="customer_phone" placeholder="Phone Number" tabindex="8">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger mt-0">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 text-right">
                <!-- <div class="panel panel-default">
                                                                                                                                    <div class="panel-heading">
                                                                                                                                     <h4>Shipping Information</h4>
                                                                                                                                    </div>
                                                                                                                                    <div class="panel-body form-group form-group-sm">
                                                                                                                                     <div class="row">
                                                                                                                                      <div class="col-xs-6">
                                                                                                                                       <div class="form-group">
                                                                                                                                        <input type="text" class="form-control margin-bottom required" name="customer_name_ship" id="customer_name_ship" placeholder="Enter Name" tabindex="9">
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                        <input type="text" class="form-control margin-bottom" name="customer_address_2_ship" id="customer_address_2_ship" placeholder="Address 2" tabindex="11">
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group no-margin-bottom">
                                                                                                                                        <input type="text" class="form-control required" name="customer_county_ship" id="customer_county_ship" placeholder="Country" tabindex="13">
                                                                                                                                       </div>
                                                                                                                                      </div>
                                                                                                                                      <div class="col-xs-6">
                                                                                                                                       <div class="form-group">
                                                                                                                                        <input type="text" class="form-control margin-bottom required" name="customer_address_1_ship" id="customer_address_1_ship" placeholder="Address 1" tabindex="10">
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                        <input type="text" class="form-control margin-bottom required" name="customer_town_ship" id="customer_town_ship" placeholder="Town" tabindex="12">
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group no-margin-bottom">
                                                                                                                                        <input type="text" class="form-control required" name="customer_postcode_ship" id="customer_postcode_ship" placeholder="Postcode" tabindex="14">
                                                                                                                                       </div>
                                                                                                                                      </div>
                                                                                                                                     </div>
                                                                                                                                    </div>
                                                                                                                                   </div> -->
            </div>
        </div>
        <!-- / end client details section -->
        <table class="table table-bordered table-hover table-striped" id="invoice_table">
            <thead>
                <tr>
                    <th width="500">
                        <h4>Rooms</h4>
                    </th>
                    <th>
                        <h4>Qty</h4>
                    </th>
                    <th>
                        <h4>Price</h4>
                    </th>
                    <th>
                        <h4>Sub Total</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-group form-group-sm  no-margin-bottom">

                            <input type="text" class="form-control form-group-sm item-input invoice_product"
                                name="room_name" placeholder="Enter Product Name OR Description">
                            @if ($errors->has('room_name'))
                                <span class="text-danger mt-0">{{ $errors->first('room_name') }}</span>
                            @endif
                            <p class="item-select">or <a href="#">select a Student</a></p>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="form-group form-group-sm no-margin-bottom">
                            <input type="number" class="form-control invoice_product_qty calculate"
                                name="invoice_product_qty" value="1">
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="input-group input-group-sm  no-margin-bottom">
                            <span class="input-group-addon"></span>
                            <input type="number" class="form-control calculate invoice_product_price required"
                                name="room_fees" aria-describedby="sizing-addon1" placeholder="0.00">
                            @if ($errors->has('room_fees'))
                                <span class="text-danger mt-0">{{ $errors->first('room_fees') }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control invoice_product_price" name="invoice_product_sub[]"
                                id="invoice_product_sub" value="0.00" aria-describedby="sizing-addon1" disabled>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="invoice_totals" class="padding-right row text-right">
            <div class="col-xs-6">
                <div class="input-group form-group-sm textarea no-margin-bottom">
                    <textarea class-"form-control" name="notes" placeholder="Additional Notes..."></textarea>
                </div>
            </div>
            <div class="col-xs-6 margin-top btn-group">
                {{-- id="action_create_invoice" data-loading-text="Creating..." --}}
                <input type="submit" class="btn btn-success float-right" value="Create Reciept">
            </div>
        </div>
        <div class="row">
            
        </div>
    </form>

    <div id="insert" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Product</h4>
                </div>
                <div class="modal-body">
                    {{-- Rooms Data --}}
                    <select class="form-control item-select">
                        @isset($existingRooms)
                            @foreach ($existingRooms as $item)
                                <option value="{{ $item->fees }}"> {{ $item->room }} - {{ $item->description }}
                                </option>
                            @endforeach
                        @endisset

                    </select>
                    {{-- <p>There are no products, please add a product.</p> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="insert_customer" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select An Existing Student</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @isset($students)
                                @foreach ($students as $item)
                                    <tr>
                                        <input type="hidden" name="studentId" value="{{ $item->id }}">
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td><a href="#" class="btn btn-primary btn-xs customer-select"
                                                data-customer-id= "{{ $item->id }}"
                                                data-customer-name= "{{ $item->name }}" {{-- data-customer-email={{ $item->email }} --}}
                                                data-customer-phone={{ $item->phone }}
                                                data-customer-address-1={{ $item->villege }}
                                                data-customer-address-2={{ $item->status }}
                                                data-customer-town={{ $item->district }}
                                                data-customer-postcode={{ $item->postcode }}>
                                                Select</a></td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@extends('dashboard_layouts.main')

@section('main-container')
    <h1>Add Student</h1>
    <hr>
   
    <div id="response" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="message"></div>
    </div>

    <form method="post" action="{{ route('add.student') }}" id="create_Student" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="action" value="create_Student">
        <div class="row">
            <div class="col-xs-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Student Information</h4>
                        <div class="clear"></div>
                    </div>
                    <div class="panel-body form-group form-group-sm">
                        <div class="row">
                            <div class="col-xs-6">

                                <div class="form-group">
                                    <div class="wrapper">
                                        <!-- Profile photo -->
                                        <img src="https://i2.cdn.turner.com/cnnnext/dam/assets/140926165711-john-sutter-profile-image-large-169.jpg"
                                            alt="" class="image--cover" />

                                        <input type="file" class="form-control bg-black copy-input required"
                                            name="photo" id="" placeholder="Enter full Name" tabindex="1">
                                        @if ($errors->has('photo'))
                                            <span class="text-danger mt-0">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control mt-10 copy-input required" name="name"
                                        id="Student_name" placeholder="Enter full Name" tabindex="1">
                                    @if ($errors->has('name'))
                                        <span class="text-danger mt-0">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="villege"
                                        id="Student_address_1" placeholder="Villege Name" tabindex="3">
                                    @if ($errors->has('villege'))
                                        <span class="text-danger mt-0">{{ $errors->first('villege') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="district"
                                        id="Student_town" placeholder="District" tabindex="5">
                                    @if ($errors->has('district'))
                                        <span class="text-danger mt-0">{{ $errors->first('district') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="postcode"
                                        id="Student_postcode" placeholder="Postcode" tabindex="7">
                                    @if ($errors->has('postcode'))
                                        <span class="text-danger mt-0">{{ $errors->first('postcode') }}</span>
                                    @endif
                                </div> --}}
                                <div class="form-group no-margin-bottom">
                                    <input type="text" class="form-control required" name="father_phone"
                                        id="invoice_phone" placeholder="Father Phone Number" tabindex="8">
                                    @if ($errors->has('father_phone'))
                                        <span class="text-danger mt-0">{{ $errors->first('father_phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6">
                                {{-- <div class="input-group float-right margin-bottom">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control copy-input required" name="fees"
                                        id="Student_email" placeholder="Email" aria-describedby="sizing-addon1"
                                        tabindex="2">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div> --}}
                                <div class="form-group">
                                    <input type="text" class="form-control  copy-input" name="taluka"
                                        id="Student_address_2" placeholder="Taluka" tabindex="4">
                                    @if ($errors->has('taluka'))
                                        <span class="text-danger">{{ $errors->first('taluka') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="joining_date"
                                        id="joining_date" placeholder="Joining Date" tabindex="6">
                                    @if ($errors->has('joining_date'))
                                        <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control required" name="phone" id="invoice_phone"
                                        placeholder="Phone Number" tabindex="8">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group no-margin-bottom">
                                    <select name="status" class="form-control required" id="slct">
                                        <option value=""> Select Status </option>
                                        <option value="Student"> Student </option>
                                        <option value="Employee"> Employee </option>
                                        <option value="Other"> Other </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 text-right">


                <!-- Employee -->

                <div id="status">
                    {{-- Jquery Data from script.js file --}}
                </div>
                <!-- Student Info -->

                {{-- <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Student info</h4>
                    </div>
                    <div class="panel-body form-group form-group-sm">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control margin-bottom required" name="last_exam"
                                        id="Student_name_ship" placeholder="Last Exam Name" tabindex="9">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control margin-bottom" name="college_name"
                                        id="Student_address_2_ship" placeholder="Enter College Name" tabindex="11">
                                </div>

                                <div class="form-group no-margin-bottom">
                                    <input type="text" class="form-control required" disabled name="college_address"
                                        id="Student_county_ship" placeholder="Enter college Address"
                                        value="Hostel Fees ₹40/day" tabindex="13">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control margin-bottom required"
                                        name="current_college_year" id="Student_address_1_ship"
                                        placeholder="Current College Year" tabindex="10">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control margin-bottom required"
                                        name="Student_town_ship" id="Student_town_ship" placeholder="College Address"
                                        tabindex="12">
                                </div>
                                <div class="form-group no-margin-bottom">
                                    <input type="text" class="form-control required" name="Student_postcode_ship"
                                        id="Student_postcode_ship" placeholder="Postcode" tabindex="14">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 margin-top btn-group">
                <input type="submit" id="action_create_Student" class="btn btn-success float-right"
                    value="Create Student" data-loading-text="Creating...">
            </div>
        </div>
    </form>
@endsection

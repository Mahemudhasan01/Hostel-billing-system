@extends('dashboard_layouts.main')

@section('main-container')
    <h1>Add Student</h1>
    <hr>
   
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
    <form method="post" action="{{ route('make.left',isset($student->id) ? $student->id : 0 )}}" id="create_Student" enctype="multipart/form-data">
        @csrf
        @foreach ($errors->all() as $error)
            <li style="color: green; font-weight: bold;">{{ $error }}</li>
        @endforeach
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
                                        <img width="300px" src="{{ isset($student->photo) && $student->photo != "" ? asset($student->photo) : asset('images/profilLogo.jpg')}}"
                                            alt="" class="image--cover" style="width: 153px; margin-left: 57px;" />

                                        <input type="file" class="form-control bg-black copy-input required"
                                            name="photo" id="" placeholder="Enter full Name" tabindex="1">

                                        <input type="hidden" name="oldPhoto" value="{{ isset($student->photo) ? asset($student->photo) : '' }}">
                                        @if ($errors->has('photo'))
                                            <span class="text-danger mt-0">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control mt-10 copy-input required" name="name"
                                        id="Student_name" placeholder="Enter full Name" value="{{ isset($student->name) ? $student->name : '' }}" tabindex="1">
                                    @if ($errors->has('name'))
                                        <span class="text-danger mt-0">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="villege"
                                        id="Student_address_1" placeholder="Villege Name" value="{{ isset($student->villege) ? $student->villege : '' }}" tabindex="3" required>
                                    @if ($errors->has('villege'))
                                        <span class="text-danger mt-0">{{ $errors->first('villege') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="district"
                                        id="Student_town" placeholder="District" tabindex="5" value="{{ isset($student->district) ? $student->district : '' }}" required>
                                    @if ($errors->has('district'))
                                        <span class="text-danger mt-0">{{ $errors->first('district') }}</span>
                                    @endif
                                </div>
                                <div class="form-group no-margin-bottom">
                                    <input type="text" class="form-control required" name="father_phone"
                                        id="fatherNumber" onblur="validatePhoneNo(this)" maxlength="10" value="{{ isset($student->father_phone) ? $student->father_phone : '' }}" placeholder="Father Phone Number" tabindex="8" required>
                                    @if ($errors->has('father_phone'))
                                        <span class="text-danger mt-0">{{ $errors->first('father_phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control  copy-input" name="taluka"
                                        id="Student_address_2" placeholder="Taluka" tabindex="4" value="{{ isset($student->town) ? $student->town : '' }}" required>
                                    @if ($errors->has('taluka'))
                                        <span class="text-danger">{{ $errors->first('taluka') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control copy-input required" name="joining_date"
                                        id="joining_date" placeholder="Joining Date" tabindex="6" value="{{ isset($student->joining_date) ? $student->joining_date : '' }}" autocomplete="off" required>
                                    @if ($errors->has('joining_date'))
                                        <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control required" name="phone" maxlength="10" id="phoneNumber" value="{{ isset($student->phone) ? $student->phone : '' }}" onblur="validatePhoneNo(this)"
                                        placeholder="Phone Number" tabindex="8" required>
                                        <span class="text-danger" id="phoneNumberError"></span>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type='text' class='form-control required' name='postcode' id='Student_postcode_ship' value="{{ isset($student->postcode) ? $student->postcode : '' }}" placeholder='Postcode' tabindex='14' maxlength="6" required> 
                                    @if ($errors->has('postcode'))
                                        <span class="text-danger">{{ $errors->first('postcode') }}</span>
                                    @endif
                                </div>
                                <div class="form-group no-margin-bottom">
                                    <select name="room_no" class="form-control required" id="studentRoom" >
                                        <option value=""> Select Room </option>
                                        @foreach ($rooms as $room)
                                            <option value="{{$room->id}}" {{ isset($student->room_no) ? ($room->id == $student->room_no) ? 'selected' : '' : '' }}>{{ $room->room }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group no-margin-bottom">
                                    <select name="status" class="form-control required" onchange="selectStudetnStatus()" value="{{ isset($student->status) ? $student->status : '' }}" id="slct">
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
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 margin-top btn-group">
                <input type="submit" id="action_create_Student" style="color: black; font-weight: bold" class="btn btn-warning float-right"
                    value=" Left The Student " data-loading-text="Creating...">
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            var option = '<?php echo isset($student->status) ? $student->status : "" ; ?>';
            var opType = '<?php echo $opType; ?>';
            var studentData = <?php echo json_encode($student); ?>;
    
            if(opType == 'edit'){
                $('#slct option[value= '+ option +' ]').attr("selected", "selected");
                selectStudetnStatus(option, studentData);
            }
            
            $(function () {
                $("#joining_date").datepicker();
            });
    
        });
    
    </script>
@endsection


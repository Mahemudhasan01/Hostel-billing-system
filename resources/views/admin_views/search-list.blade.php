@extends('dashboard_layouts.main')

@section('main-container')
  <div style="    height: 66px;
  width: 100%;
  border-radius: 10px;
  background-color: #f5f5f5;
  padding: 1px 0px 0px 10px;
  box-shadow:0 7px 8px -5px #000;
">
    <h3 style="color:Green">Search Receipts</h3>
    {{-- <hr>   --}}
  </div>
    <div id="response" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="message"></div>
    </div>

    {{-- <div class="container"> --}}
     
        <div class="search-box" style="    position: relative;
        top: 25px;">
        <div class="row">
            <div class="col-sm-3">
              <label>To Month</label>
              <select class="form-control required" name="fromMonth" id="fromMonth" placeholder=""
              data-date-format="">
                    <option value="">From Months</option>
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
            </div>
            <div class="col-sm-3">
              <label>To Month</label>
              <select class="form-control required" name="toMonth" id="toMonth" placeholder=""
              data-date-format="" >
                    <option value="">To</option>
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
            </div>
            <div class="col-sm-3">
              <label>Room No.</label>
              <input type="text" name="roomNo" id="roomNo" class="form-control" placeholder="Room Number" value="">
            </div>
            <div class="col-sm-3">
              <label>Search Student</label>
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" id="txtSearch"/>
                  <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
              </div>
            </div>
        </div>
      </div>
        {{-- <input type="submit" onclick="findReceiptByDate()" class="btn btn-success" value="Submit" style="display: block; --}}
        margin: auto;
        margin-top: 45px;">
        <div class="panel-body form-group form-group-sm">
          <table class="table table-striped table-hover table-bordered" id="data-table">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>Receipt No.</th>
                      <th>Student Name</th>
                      <th>Start Month</th>
                      <th>End Month</th>
                      <th>Total Fees</th>
                      <th>Villege</th>
                      <th>Room</th>
                      <th>Phone</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="bodyReceiptData">
              
                </tbody>
          </table>
      </div>
@endsection

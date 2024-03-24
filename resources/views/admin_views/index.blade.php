
@extends('layouts.main')

@section('main-container')

<div class="row vertical-offset-100">
	<div id="response" class="alert alert-success" style="display:none;">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<div class="message"></div>
	</div>

	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default login-panel">
		  	<div class="panel-heading panel-login">
		  		<h3 class="text-center">
					{{-- <img src="{{asset('system-img/logo.png')}}" class="img-responsive"> --}}
					Mashayakh Hostel

				</h3>
		    	
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" action="{{route('submit.login')}}" role="form" method="post" id="login_form">
					@csrf
					@foreach ($errors->all() as $error)
						<li style="color: red; font-weight: bold;">{{ $error }}</li>
					@endforeach
		    		<input type="hidden" name="action" value="login">
	                <fieldset>
			    	  	<div class="input-group form-group">
			    	  		<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
			    		    <input class="form-control required" name="username" id="username" type="text" placeholder="Enter Username" required>
			    		</div>
			    		<div class="input-group form-group">
			    		 	<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
			    			<input class="form-control required"  placeholder="Password" name="password" type="password" placeholder="Enter Password" required>
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    	<!--a href="forgot.php" class="float-right">Forgot password?</a-->
			    	    </div>
			    		<button type="submit" class="btn btn-danger btn-block">Login</button><br>
			    	</fieldset>
		      	</form>
		    </div>
		</div>
	</div>
</div>

@endsection
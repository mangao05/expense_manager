@extends('layouts.master');

@section('content')
	<h3 class="text-center">Change Password</h3>
	<form action="/changepassword" method="POST">
		@csrf
	    <div class = "col-lg-4 offset-lg-4 p-5" style="box-shadow: 0px 0px 3px gray;">
	        <div class="form-group">
				<label for="old_password">Old Password:</label>
	            <input type ="password" name="old_password" class="form-control border border-dark rounded-0"/>
	        </div>
	        <div class="form-group">
	        	<label for="password">New Password</label>
	        	<input type="password" name="password" id="password" class="form-control border border-dark rounded-0">
	        </div>
	        <div class="form-group">
	        	<label for="password_confirmation">Retype Password</label>
	        	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control border border-dark rounded-0">
	        </div>
	        <a href="#" class="text-primary" status="0" id="showPassword"><i class="fas fa-eye" ></i>Show Password</a>
	        <input type="submit" value="Submit" class="btn btn-outline-dark rounded-0 text-uppercase font-weight-bold btn-block">
	    </div>
	</form>

@endsection

@section('script')
	
	<script>
		$("#showPassword").click(function(e){
			e.preventDefault();
			if($(this).attr('status') == 0){
				$("input[type='password']").attr('type', 'text');
				$(this).html("Hide Password");
				$(this).attr('status', 1);
			}else{
				$(this).attr('status', 0);
				$(this).html("Show Password");
				$("input[type='text']").attr('type', 'password');

			}
			
		});
	</script>

@endsection
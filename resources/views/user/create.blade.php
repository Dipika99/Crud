@extends('layouts.app')
@section('content')
<div class="col-sm-3 sidenav">
	<h4>John's Blog</h4>
	<ul class="list-group">
		<li class="list-group-item"><a href="/users">List Users</a></li>
	</ul>
	<br>
</div>
<div class="col-sm-9" style="background-color:white">
	<h4>
		<small>
			<h1>Add User</h1>
		</small>
	</h4>
	<hr>
	<form method="post" action="{{ route('companies.store') }}">
		{{  @csrf_field() }}
		@method('POST') 	
		<div class="form-group">
			<label for="name">First Name:<span class="required">*</span></label>
			<input  class="form-control" required  name="name">
		</div>
		<div class="form-group">
			<label for="type">Last Name:<span class="required">*</span></label>
			<input  required class="form-control" name="type">
		</div>
		<div class="form-group">
			<label for="site_url">Phone No:<span class="required">*</span></label>
			<input  class="form-control" required  name="site_url">
		</div>
		<div class="form-group">
			<label for="description">Description:<span class="required">*</span></label>
			<textarea  required class="form-control" style="resize:vertical" name="description"></textarea>
		</div>
		<input type="submit" class="btn btn-success" value="Submit">
	</form>
	<br><br>
</div>
@endsection
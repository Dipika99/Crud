@extends('layouts.app')
@section('content')
<div class="col-sm-12"  style="background-color:white;">
	<h4>
		<small>
			<h1>Users</h1>
		</small>
	</h4>
	<div class="card">
		<div class="card-body" >
			<div class="table-responsive">
				<table width="100%" class="table table-striped table-bordered responsive">
					<thead>
						<tr>
							
							<th> User Name</th>
							<th> Email</th>
							<th> Phone</th>
							<th> Image</th>
						</tr>
					</thead>
					<tbody>
						@if(count($users)>0)							
						@foreach($users as $k=>$u)
						<tr>
							
							<td>{{ $u->first_name}}{{ $u->last_name}}</td>
							<td>{{ $u->email}}</td>
							<td>{{ $u->phone}}</td>
							<td><img height="50" width="50" src="{{ asset('public/storage/user/'.$u->profile_image)}}" alt="img"></td>
						</tr>
						@endforeach 
						@endif		
					</tbody	>
				</table>
			</div>
		</div>
	</div>
	<ul class="list-group">
		<li class="list-group-item">{{ $users->links() }}</li>
	</ul>
</div>
@endsection
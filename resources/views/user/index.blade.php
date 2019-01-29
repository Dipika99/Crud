@extends('layouts.app')
@section('content')
<div class="col-sm-9">
<h4><small><h1>Users</h1></small></h4>
 <ul class="list-group">
	    @foreach($users as $u)
	    	<li class="list-group-item"><a href="#">{{ $u->first_name}}{{ $u->last_name}}</a>
			</li>
        @endforeach   
<li class="list-group-item">{{ $users->links() }}</li>
   </ul>
</div>
	
@endsection
@section('page-script')
<script>
$(document).ready(function () {
 $(document).on('click','.pagination a', function(e){
    e.preventDefault()
	var page = $(this).attr('href').split('page=')[1];
	getUsers(page);
    function getUsers(page){
    $.ajax ({
    url:'users/?page='+page 
    }).done(function (data){
    $('body').html(data);
    });
    }
    });
 });
</script>
@endsection
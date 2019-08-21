@extends('admin.includes.main')

@section('content')
		<a class="btn btn-success" data-toggle="modal" data-target="#modal-default" href=""><i class="fa fa-user-plus"></i>&nbsp;Add User</a>

     	@include('admin.contents.user.create')
     	<br><br>
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User Registrations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="center">No</th>
                  <th class="center">Name</th>
                  <th class="center">Username</th>
                  <th class="center">Email</th>
                  <th class="center">Role</th>
                  <th class="center">Action</th>
                </tr>
                </thead>
                <tbody>
               	<?php $i = 1 ?>  
		        @foreach ($user as $data) 
                <tr>
                	<td class="center">{{ $i }}</td>
                	<td>{{ $data->name }}</td>
                	<td>{{ $data->username }}</td>
                	<td>{{ $data->email }}</td>
                	<td>{{ $data->roles->name }}</td>
                	<td class="center">
		                <a href="{{ route('edit_user', $data->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" ></i></a>
		              	<form data-parsley-validate method="POST" action="{{ route('delete_user', $data->id) }}" style="display: inline;">
		                	<input type="hidden" name="_method" value="DELETE">
		                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		               		{{ csrf_field() }}
		                	<button type="submit" class="btn btn-danger btn-xs confirmation"><i class="fa fa-trash-o"></i></button>
		            	</form>
                	</td>
                </tr>
	            <?php $i++ ?>
	            @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        <style type="text/css">
		  .center{
		  	text-align: center;
		  }
		</style>
@endsection
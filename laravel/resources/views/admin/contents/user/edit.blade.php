@extends('admin.includes.main')

@section('content')
<style type="text/css">
  .photo{
    width: 300px;
    height: 400px;
  }
</style>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data</h3>
            </div>            

            <form role="form" action="{{ route('update_user', $data->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $data->username }}" required autofocus>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $data->email }}" required autofocus>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required autofocus>
                          @foreach ($role as $role)
                              <option @if ($data->role == $role->id) selected @endif value="{{ $role->id }}"> {{ $role->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Upload Photo</label>
                    <input type="file" name="image" accept="image/*">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="image2" value="{{ $data->image }}">
                    <img class="img-responsive photo" src="{{ asset($image) }}">
                  </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="pull-right">
                  <a href="{{ route('user') }}" class="btn btn-default">Back</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
             </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
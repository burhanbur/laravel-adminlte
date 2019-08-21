        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add User</h4>
              </div>
              <div class="modal-body">
                <!-- form start -->
                <form action="{{ route('store_user') }}" method="POST" role="form" enctype="multipart/form-data">
                  @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Name" required autofocus>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
                    </div>
                    <div class="form-group">
                    <label>Role</label>                      
                      <select name="role" class="form-control" required autofocus>
                          <option value=""> -- Select Role -- </option>
                          @foreach ($role as $role)
                              <option value="{{ $role->id }}"> {{ $role->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Photo</label>
                      <input type="file" name="image" accept="image/*">
                    </div>
                  </div>
                  <!-- /.box-body -->

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
    <!-- Header -->
     @include('admin.header')
      
     <!-- Siderbar -->
     @include('admin.sidebar')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Department List</h3>
                    <div class="box-tools">
                        <button id="addNewBtn" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#addDepartmentModal">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>SL#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($departments as $key => $department)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->description }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
            <!-- Add Department Modal -->
            <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('departments.store') }}" method="POST" id="addDepartmentForm">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="departmentName">Department Name</label>
                                    <input type="text" class="form-control" id="departmentName" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="departmentDescription">Description</label>
                                    <textarea class="form-control" id="departmentDescription" name="description" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        
      </footer>
    </div><!-- ./wrapper -->

    <!-- script -->
     @include('admin.script')


  </body>
</html>
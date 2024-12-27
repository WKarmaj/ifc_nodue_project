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
                            <h3 class="box-title">Import Student Data</h3>
                            <div class="box-tools">
                                <!-- Search Bar -->
                                <form action="{{ route('admin.std_management') }}" method="GET" class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <!-- Import Button -->
                                <button id="addImportBtn" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#importStudentModal">
                                    <i class="fa fa-download"></i> Import
                                </button>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover" id="studentTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <a href="{{ route('admin.std_management', ['sortField' => 'name', 'sortOrder' => request('sortOrder') === 'asc' ? 'desc' : 'asc']) }}">
                                                Name <i class="fa fa-sort"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('admin.std_management', ['sortField' => 'student_id', 'sortOrder' => request('sortOrder') === 'asc' ? 'desc' : 'asc']) }}">
                                                Student ID <i class="fa fa-sort"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('admin.std_management', ['sortField' => 'programme_id', 'sortOrder' => request('sortOrder') === 'asc' ? 'desc' : 'asc']) }}">
                                                Programme ID <i class="fa fa-sort"></i>
                                            </a>
                                        </th>
                                        <th>Contact No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $key => $student)
                                        <tr>
                                            <td>{{ $students->firstItem() + $key }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->programme_id }}</td>
                                            <td>{{ $student->contact_no }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                           
                        </div>

                      </div><!-- /.box -->
                  </div>
              </div>
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <div class="modal fade" id="importStudentModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="importModalLabel">Import Students</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="importStudentForm" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="file">Choose Excel File</label>
                  <input type="file" name="file" class="form-control" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="importStudentForm" class="btn btn-primary">Import</button>
            </div>
          </div>
        </div>
      </div>

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        
      </footer>
    </div><!-- ./wrapper -->

    <!-- script -->
     @include('admin.script')


  </body>
</html>
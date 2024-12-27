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
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Facility List</h3>
                    <div class="box-tools">
                        <button id="addNewFacility" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#addFacilityModal">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                </div> <!-- /.box-header -->
                <!-- Add Facility Modal -->
                <div class="modal fade" id="addFacilityModal" tabindex="-1" role="dialog" aria-labelledby="addFacilityModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('facilities.storeFacility') }}" method="POST" id="addFacilityForm">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addFacilityModalLabel">Add New Facility</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="facilityName">Facility Name</label>
                                        <input type="text" class="form-control" id="facilityName" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="facilityDescription">Description</label>
                                        <textarea class="form-control" id="facilityDescription" name="description" rows="3" required></textarea>
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

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>SL#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($facilities as $key => $facility)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->description }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editFacilityModal{{ $facility->id }}">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('facilities.destroyFacility', $facility->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this facility?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Facility Modal -->
                        <div class="modal fade" id="editFacilityModal{{ $facility->id }}" tabindex="-1" role="dialog" aria-labelledby="editFacilityModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('facilities.updateFacility', $facility->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editFacilityModalLabel">Edit Facility</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="facilityName{{ $facility->id }}">Facility Name</label>
                                                <input type="text" class="form-control" id="facilityName{{ $facility->id }}" name="name" value="{{ $facility->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="facilityDescription{{ $facility->id }}">Description</label>
                                                <textarea class="form-control" id="facilityDescription{{ $facility->id }}" name="description" rows="3" required>{{ $facility->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </table>
                </div>

                <!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
       
      </footer>
    </div><!-- ./wrapper -->

    <!-- script -->
     @include('admin.script')
  </body>
</html>
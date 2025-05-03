@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pin Offices</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pin Offices</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.pinOffices.importForm') }}" class="btn btn-primary">Import Pin Office</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="pinOfficesTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Circle Name</th>
                            <th>Region Name</th>
                            <th>Division Name</th>
                            <th>Office Name</th>
                            <th>Pin Code</th>
                            <th>State</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be filled by DataTables -->
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#pinOfficesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.pins') }}", // Ensure this route points to your controller method
        columns: [
            { data: 'circle_name', name: 'circle_name' },
            { data: 'region_name', name: 'region_name' },
            { data: 'division_name', name: 'division_name' },
            { data: 'office_name', name: 'office_name' },
            { data: 'pin', name: 'pin' },
            { data: 'state', name: 'state' },
        ]
    });
});
</script>
@endsection

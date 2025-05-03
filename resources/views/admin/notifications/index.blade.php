@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Notifications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Notifications</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.notification.create') }}" class="btn btn-primary">Add Notification</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="notificationsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Notification</th>
                            <th>Action</th>
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
<!-- /.content-wrapper -->

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize the DataTable
    var table = $('#notificationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.notification') }}", 
        columns: [
            { data: 'customer_name', name: 'customer_name' }, 
            { data: 'notification_message', name: 'notification_message' }, 
            { data: 'action', name: 'action', orderable: false, searchable: false } 
        ]
    });
});
</script>
@endsection

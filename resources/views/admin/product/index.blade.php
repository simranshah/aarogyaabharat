@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <div class="card-body">
          <table id="productsTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Image</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.products') }}", // URL for the AJAX call
        columns: [
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category.name' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'price', name: 'price' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        columnDefs: [
            {
                targets: 2, // Image column
                render: function(data, type, full) {
                    return full.image; // Render image HTML
                }
            }
        ]
    });
});
</script>
@endsection

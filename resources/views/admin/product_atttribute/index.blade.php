@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Attributes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Attributes</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.products.attribute.create') }}" class="btn btn-primary">Add Product Attribute</a>
        </div>
        <div class="card-body">
          <table id="attributesTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Size</th>
                <th>Color</th>
                <th>Weight</th>
                <th>Material</th>
                <th>Brand</th>
                <th>Model Number</th>
                <th>Expiration Date</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#attributesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.products.attribute') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'stock', name: 'stock' },
            { data: 'size', name: 'size' },
            { data: 'color', name: 'color' },
            { data: 'weight', name: 'weight' },
            { data: 'material', name: 'material' },
            { data: 'brand', name: 'brand' },
            { data: 'model_number', name: 'model_number' },
            { data: 'expiration_date', name: 'expiration_date' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection

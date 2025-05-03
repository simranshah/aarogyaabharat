@extends('admin.layout.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Happy Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Happy Customer</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><small>Edit Happy Customer</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="happyCustomerForm" method="POST" action="{{ route('admin.happy.customers.update', $customer->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Customer Name" value="{{ old('name', $customer->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" placeholder="Enter Customer Comment">{{ old('comment', $customer->comment) }}</textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="rate">Rate (1-5)</label>
                                    <input type="number" name="rate" class="form-control @error('rate') is-invalid @enderror" id="rate" placeholder="Enter Rating" value="{{ old('rate', $customer->rate) }}" min="1" max="5">
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city"
                                        class="form-control @error('city') is-invalid @enderror" id="city"
                                        placeholder="Enter Customer City" value="{{ old('city' , $customer->city) }}">

                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="city">State</label>
                                    <input type="text" name="state"
                                        class="form-control @error('state') is-invalid @enderror" id="state"
                                        placeholder="Enter Customer State" value="{{ old('state' , $customer->state) }}">

                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

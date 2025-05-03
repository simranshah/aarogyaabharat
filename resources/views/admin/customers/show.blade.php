@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Customer Details</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer #{{ $customer->id }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $customer->name }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Phone:</strong> {{ $customer->mobile }}</p>

                <h4>Address Details</h4>
                @if ($customer->addresses->isNotEmpty())
                @foreach ($customer->addresses as $address)
                    <div class="{{ $address->is_delivery_address == 1 ? 'bg-success text-white' : 'bg-light' }} p-3 mb-3">
                        <p><strong>House Number:</strong> {{ $address->house_number }}</p>
                        <p><strong>Society Name:</strong> {{ $address->society_name }}</p>
                        <p><strong>Locality:</strong> {{ $address->locality }}</p>
                        <p><strong>Landmark:</strong> {{ $address->landmark }}</p>
                        <p><strong>City:</strong> {{ $address->city }}</p>
                        <p><strong>Pin/Zip Code:</strong> {{ $address->pincode }}</p>
                    </div>
                    <hr/>
                @endforeach
                @else
                    <p>No address available for this customer.</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.customers') }}" class="btn btn-secondary">Back to Customers</a>
            </div>
        </div>
    </section>
</div>
@endsection

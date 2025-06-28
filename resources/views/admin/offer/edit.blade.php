@extends('admin.layout.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Offer and Discount</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Offer and Discount</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><small>Edit Offer and Discount</small></h3>
              </div>

              <form id="quickForm" action="{{ route('admin.offer.update', $offerAndDiscount->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="typeInput">Type</label>
                    <select name="type" class="form-control" id="typeInput">
                      <option value="percentage" {{ $offerAndDiscount->type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                      <option value="amount" {{ $offerAndDiscount->type == 'amount' ? 'selected' : '' }}>Amount</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="valueInput">Value</label>
                    <input type="number" name="value" class="form-control" id="valueInput" placeholder="Enter Value" value="{{ old('value', $offerAndDiscount->value) }}">
                    @error('value')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="valueInput">Up-to Off</label>
                    <input type="number" name="up_to_off" class="form-control" id="valueInput" placeholder="Enter Up-to Off" value="{{ old('up_to_off', $offerAndDiscount->up_to_off) }}">
                    @error('up_to_off')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="completeOffInput">Complete Off On</label>
                    <select name="complete_off_on" class="form-control" id="completeOffInput">
                      <option value="">Select Option</option>
                      <option value="delivery" {{ old('complete_off_on', $offerAndDiscount->complete_off_on) == 'delivery' ? 'selected' : '' }}>Delivery</option>
                      <option value="gst" {{ old('complete_off_on', $offerAndDiscount->complete_off_on) == 'gst' ? 'selected' : '' }}>GST</option>
                    </select>
                    @error('complete_off_on')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="valueInput">Code</label>
                    <input type="text" name="code" class="form-control" id="valueInput" placeholder="Enter Code" value="{{ old('code', $offerAndDiscount->code) }}">
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="startDateInput">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="startDateInput" value="{{ old('start_date', $offerAndDiscount->start_date) }}">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="endDateInput">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="endDateInput" value="{{ old('end_date', $offerAndDiscount->end_date) }}">
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                    <div class="form-group">
                      <label for="showOnSiteInput">Show on Site</label>
                      <select name="show_on_site" class="form-control" id="showOnSiteInput">
                        <option value="0" {{ old('show_on_site', $offerAndDiscount->show_on_site) == '0' ? 'selected' : '' }}>False</option>
                        <option value="1" {{ old('show_on_site', $offerAndDiscount->show_on_site) == '1' ? 'selected' : '' }}>True</option>
                      </select>
                      @error('show_on_site')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="usageLimitInput">Usage Limit</label>
                      <input type="number" name="usage_limit" class="form-control" id="usageLimitInput" placeholder="Enter Usage Limit" value="{{ old('usage_limit', $offerAndDiscount->usage_limit) }}">
                      @error('usage_limit')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" name="title" class="form-control" id="titleInput" placeholder="Enter Title" value="{{ old('title', $offerAndDiscount->title) }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="descriptionInput">Description</label>
                    <textarea name="description" class="form-control" id="descriptionInput" placeholder="Enter Description">{{ old('description', $offerAndDiscount->description) }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="imageInput">Image</label>
                    <input type="file" name="image" class="form-control" id="imageInput">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  @if ($offerAndDiscount->image)
                    <div class="form-group">
                      <img src="{{ Storage::url($offerAndDiscount->image) }}" alt="Current Image" class="img-fluid">
                    </div>
                  @endif
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

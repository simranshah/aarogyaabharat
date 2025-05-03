@extends('admin.layout.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Question</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Question</li>
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
                <h3 class="card-title"><small>Create Question</small></h3>
              </div>

              <form id="quickForm" action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="questionInput">Question</label>
                    <input type="text" name="question" class="form-control" id="questionInput" placeholder="Enter Question" value="{{ old('question') }}">
                    @error('question')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                                    <label for="productCategory">Category</label>
                                    <select name="category" class="form-control @error('category') is-invalid @enderror" id="productCategory">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" {{ old('category') == $category['id'] ? 'selected' : '' }}>
                                                {{ $category['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                  <div class="form-group">
                    <label for="answerInput">Answer</label>
                    <textarea name="answer" class="form-control" id="answerInput" placeholder="Enter Answer">{{ old('answer') }}</textarea>
                    @error('answer')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

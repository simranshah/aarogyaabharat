@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Import Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Import Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Import Products</h3>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="alert alert-info">
                                <h5><i class="icon fas fa-info"></i> Important Notes:</h5>
                                <ul>
                                    <li>For large files (1000+ rows), consider using the command line: <code>php artisan products:import path/to/your/file.xlsx</code></li>
                                    <li>Maximum file size: 50MB</li>
                                    <li>Supported formats: XLSX, CSV</li>
                                    <li>Import timeout: 5 minutes (web) / Unlimited (command line)</li>
                                    <li>Empty rows will be automatically skipped</li>
                                </ul>
                            </div>

                            <form action="{{ route('admin.products.importstore') }}" method="POST" enctype="multipart/form-data" id="importForm">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Choose File</label>
                                    <input type="file" name="file" class="form-control" id="file" required accept=".xlsx,.csv">
                                    <small class="form-text text-muted">Select an Excel (.xlsx) or CSV file to import</small>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="confirmImport">
                                        <label class="custom-control-label" for="confirmImport">
                                            I understand that this import may take several minutes for large files
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" id="importBtn" disabled>
                                    <i class="fas fa-upload"></i> Import Products
                                </button>
                                
                                <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Products
                                </a>
                            </form>

                            <div id="importProgress" style="display: none;" class="mt-3">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">Importing products... Please do not close this page.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const confirmCheckbox = document.getElementById('confirmImport');
    const importBtn = document.getElementById('importBtn');
    const importForm = document.getElementById('importForm');
    const importProgress = document.getElementById('importProgress');

    // Enable/disable import button based on checkbox
    confirmCheckbox.addEventListener('change', function() {
        importBtn.disabled = !this.checked;
    });

    // Show progress when form is submitted
    importForm.addEventListener('submit', function() {
        importProgress.style.display = 'block';
        importBtn.disabled = true;
        importBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Importing...';
    });
});
</script>
@endsection

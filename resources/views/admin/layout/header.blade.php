<nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
    

<!-- Display Auth User Name -->
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-user"><p>{{ auth()->user()->name }}</p></i>
    </a>
</li>

<!-- Logout Form -->
<li class="nav-item">
    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="nav-link btn btn-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </button>
    </form>
</li>
    </ul>
  </nav>
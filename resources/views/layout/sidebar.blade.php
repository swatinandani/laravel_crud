<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="{{ route('dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

   <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('users.index') }}">
      <i class="bi bi-envelope"></i>
      <span>Users</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('roles') }}">
      <i class="bi bi-envelope"></i>
      <span>Roles</span>
    </a>
  </li>

</ul>

</aside>
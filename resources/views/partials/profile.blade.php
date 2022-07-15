<ul class="header-nav ms-3">
  <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('assets/img/avatars/8.jpg') }}" alt="user@email.com"></div>
    </a>
    <div class="dropdown-menu dropdown-menu-end pt-0">
      <div class="dropdown-header bg-light py-2">
        <div class="fw-semibold">Settings</div>
      </div><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
        </svg> Profile</a><a class="dropdown-item" href="#">
        
        <a class="dropdown-item" href="{{ url('logout') }}">
        <svg class="icon me-2">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
        </svg> Logout</a>
    </div>
  </li>
</ul>
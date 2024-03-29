<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="{{ asset('assets/brand/coreui.svg#full') }}"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="{{ asset('assets/brand/coreui.svg#signet') }}"></use>
      </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
          </svg> Dashboard  
        </a>
    </li>
      <li class="nav-title">Theme</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/wallets') }}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-drop') }}"></use>
          </svg> Wallets
        </a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('expense_categories') }}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg> Expense Category
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('expenses') }}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg> Expense
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('income_categories') }}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg> Income Category
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('incomes') }}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg> Income
        </a>
    </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>
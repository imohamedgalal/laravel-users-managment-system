  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ URL::asset('adminlte/assets/img/applogo/applogo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MG Sniper</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('adminlte/assets/img/applogo/'. Auth::user()->username . '.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fa fa-home nav-icon"></i>
            <p>{{ trans('main_translate.Home') }}</p>
        </a>
        </li>

        @can('show_users')
        <li class="nav-item">
        <a href="{{ route('index_users') }}" class="nav-link">
            <i class="fa fa-users nav-icon"></i>
            <p>{{ trans('main_translate.Users') }}</p>
        </a>
        </li>
        @endcan


        @can('create_users')
        <li class="nav-item">
        <a href="{{ route('create_user') }}" class="nav-link">
            <i class="fa fa-user-plus nav-icon"></i>
            <p>{{ trans('main_translate.Add User') }}</p>
        </a>
        </li>
        @endcan

        @can('show_admins')
        <li class="nav-item">
        <a href="{{ route('index_admins') }}" class="nav-link">
            <i class="fa fa-users nav-icon"></i>
            <p>{{ trans('main_translate.Admins') }}</p>
        </a>
        </li>
        @endcan

        @can('show_logs')
        <li class="nav-item">
        <a href="{{ route('admin_logs') }}" class="nav-link">
            <i class="fa fa-edit nav-icon" ></i>
            <p>{{ trans('main_translate.Activity Logs') }}</p>
        </a>
        </li>
        @endcan

        @can('show_roles')
        <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link">
            <i class="fa fa-key nav-icon"></i>
            <p>{{ trans('main_translate.Roles & Permissions') }}</p>
        </a>
        </li>
        @endcan

        @can('show_product')
        <li class="nav-item">
        <a href="{{ route('index_products') }}" class="nav-link">
            <i class="fa fa-flag nav-icon"></i>
            <p>{{ trans('main_translate.Products') }}</p>
        </a>
        </li>
        @endcan

        @can('show_agent')
        <li class="nav-item">
        <a href="{{ route('index_agents') }}" class="nav-link">
            <i class="fa fa-user-secret nav-icon"></i>
            <p>{{ trans('main_translate.Agents') }}</p>
        </a>
        </li>
        @endcan

        @can('show_reseller')
        <li class="nav-item">
        <a href="{{ route('index_resellers') }}" class="nav-link">
            <i class="fa fa-user-secret nav-icon"></i>
            <p>{{ trans('main_translate.Resellers') }}</p>
        </a>
        </li>
        @endcan

        @can('show_payment')
        <li class="nav-item">
        <a href="{{ route('index_payments') }}" class="nav-link">
            <i class="fa fa-credit-card nav-icon"></i>
            <p>{{ trans('main_translate.payments') }}</p>
        </a>
        </li>
        @endcan

        @can('show_settings')
        <li class="nav-item">
        <a href="{{ route('index_settings') }}" class="nav-link">
            <i class="fa fa-cog nav-icon"></i>
            <p>{{ trans('main_translate.Settings') }}</p>
        </a>
        </li>
        @endcan

        <li class="nav-item">
        <form id="logout2-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout2-form').submit();" class="nav-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>{{ trans('main_translate.Logout') }}</p>
        </a>
        </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

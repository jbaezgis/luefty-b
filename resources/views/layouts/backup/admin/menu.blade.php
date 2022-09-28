 <!-- Arreglo para menu activo -->
 <?php function activeMenu($url){
    return request()->is($url) ? 'active' : '';
  }?>
   <?php function menuOpen($url){
    return request()->is($url) ? 'menu-open' : '';
  }?>
<!-- fin -->

 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ activeMenu('administration') }}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{ activeMenu('administration/tasks*') }}"><a href="{{URL::to('administration/tasks')}}"><i class="fa fa-tasks"></i> <span>Tasks</span></a></li>
            @if (Auth::user()->hasRole('administration'))
              <li class="{{ activeMenu('administration/users*') }}"><a href="{{URL::to('administration/users')}}"><i class="fa fa-users"></i> All users</a></li>
            @endif
            {{-- <li class="{{ activeMenu('administration/updates*') }}"><a href="{{URL::to('administration/updates')}}"><i class="fa fa-refresh"></i> Updates</a></li> --}}
           
            <li class="header">MAINTENANCE</li>
            <li class="{{ activeMenu('administration/faqs*') }}"><a href="{{URL::to('administration/faqs')}}"><i class="fa fa-info"></i> FAQs</a></li>
            <li class="{{ activeMenu('administration/extras*') }}"><a href="{{URL::to('administration/extras')}}"><i class="fa fa-puzzle-piece"></i> Extras</a></li>
            <li class="{{ activeMenu('administration/instructions*') }}"><a href="{{URL::to('administration/instructions')}}"><i class="fa fa-question"></i> {{ __('Instructions') }}</a></li>
            <li class="{{ activeMenu('administration/users*') }} treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Locations</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="">
                  <li class="{{ activeMenu('administration/locations*') }}"><a href="{{URL::to('administration/locations')}}"><i class="fa fa-list"></i> {{ __('Locations') }}</a></li>
                  <li class="{{ activeMenu('administration/places*') }}"><a href="{{URL::to('administration/places')}}"><i class="fa fa-list"></i> {{ __('Places') }}</a></li>
              </ul>
            </li>
            <li class="header">SYSTEM</li>
            <li class="{{ activeMenu('administration/system-log') }}"><a href="{{URL::to('administration/updates')}}"><i class="fa fa-list"></i> System log</a></li>
            <li class="{{ activeMenu('administration/updates-log') }}"><a href="{{URL::to('administration/updates')}}"><i class="fa fa-list"></i> Updates log</a></li>
            <li class="header">ADMINISTRATION</li>
            <li class="{{ activeMenu('administration/users*') }} treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="">
                  @if (Auth::user()->hasRole('admin'))
                  <li class="{{ activeMenu('administration/users*') }}"><a href="{{ url('administration/users') }}"><i class="fa fa-list"></i> {{ __('Users') }} </a></li>
                  @endif
                  @if (Auth::user()->hasRole('super-admin'))
                  <li class="{{ activeMenu('administration/roles*') }}"><a href="{{URL::to('administration/roles')}}"><i class="fa fa-list"></i> Rols</a></li>
                  <li class="{{ activeMenu('administration/permissions*') }}"><a href="{{URL::to('administration/permissions')}}"><i class="fa fa-list"></i> Permisos</a></li>
                  <li class="{{ activeMenu('administration/activitylogs') }}"><a href="{{URL::to('administration/activitylogs')}}"><i class="fa fa-list"></i> Log de usuarios</a></li>
                  @endif
              </ul>
            </li>
            <li class="{{ activeMenu('administration/settings*') }}"><a href="{{URL::to('administration/settings')}}"><i class="fa fa-gears"></i> Settings</a></li>
            <li class="{{ activeMenu('administration/updates*') }}"><a href="{{URL::to('administration/updates')}}"><i class="fa fa-refresh"></i> Updates</a></li>
            
              

            {{-- <li class="header">SISTEMA</li>
              <li class="{{ activeMenu('settings') }}"><a href="{{URL::to('admin/settings')}}"><i class="fa fa-gears"></i> <span>Settings</span></a></li> --}}
          </ul>
        </section>
        <!-- /.sidebar -->
</aside>
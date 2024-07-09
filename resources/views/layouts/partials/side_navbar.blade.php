<aside class="left-sidebar sidebar-dark" id="left-sidebar">
  <div id="sidebar" class="sidebar sidebar-with-footer">
    <!-- Application Brand -->
    <div class="app-brand">
      <a href="{{route('dashboard')}}">
        <span class="brand-name">Web App</span>
      </a>
    </div>
    <!-- begin sidebar scrollbar -->
    <div class="sidebar-left" data-simplebar style="height: 100%;">
      <!-- Sidebar menu -->
      <ul class="nav sidebar-inner" id="sidebar-menu">

        <li>
          <a class="sidenav-item-link" href="{{route('dashboard')}}">
            <i class="mdi mdi-chart-line"></i>
            <span class="nav-text">{{ __("trans.Dashboard")}}</span>
          </a>
        </li>
        @auth
        @role(['Super Admin','Admin'])
        <li class="has-sub">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#settings" aria-expanded="false" aria-controls="settings">
            <i class="mdi mdi-settings"></i>
            <span class="nav-text">{{ __("trans.Permission Center")}}</span> <b class="caret"></b>
          </a>
          
          <ul class="collapse" id="settings" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li>
                <a class="sidenav-item-link" href="{{ route('roles.index') }}">
                  <span class="nav-text">{{ __("trans.Roles")}}</span>
                </a>
              </li>
              <li>
                <a class="sidenav-item-link" href="{{ route('permissions.create') }}">
                  <span class="nav-text">{{ __("trans.Permissions")}}</span>
                </a>
              </li>
            </div>
          </ul>
        </li>
        @endrole
          @endauth
        <li class="has-sub">
          <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#projects-dropdown" aria-expanded="false" aria-controls="projects-dropdown">
            <i class="mdi mdi-format-list-bulleted-type"></i>
            <span class="nav-text">{{ __("trans.Projects")}}</span>
            <b class="caret mdi mdi-chevron-down"></b>
            <!-- Add the caret icon for the dropdown -->
          </a>
          <ul class="collapse" id="projects-dropdown" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li>
                <a href="{{route('projectsList')}}">
                  <span class="nav-text">{{ __("trans.Projects")}}</span>
                </a>
              </li>
              @auth
               @role(['Super Admin','Admin'])
              <li>
                <a href="{{ route('createProjectForm') }}">
                  <span class="nav-text">{{ __("trans.Add New Project")}}</span>
                </a>
              </li>
              @endrole
              @endauth
            </div>
          </ul>
        </li>

        <li class="has-sub">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#category-dropdown" aria-expanded="false" aria-controls="category-dropdown">
            <i class="mdi mdi-dropbox"></i>
            <span class="nav-text">{{ __("trans.Category")}}</span> <b class="caret mdi mdi-chevron-down"></b>
          </a>
          <ul class="collapse" id="category-dropdown" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <!-- <li>
                <a href="#">
                  <span class="nav-text">Project</span>
                </a>
              </li> -->
              <li>
                <a href="{{route('categoriesList')}}">
                  <span class="nav-text">{{ __("trans.Category")}}</span>
                </a>
              </li>
            </div>
          </ul>
        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#Spends-dropdown" aria-expanded="false" aria-controls="Spends-dropdown">
            <i class="mdi mdi-export-variant"></i>
            <span class="nav-text">{{ __("trans.Spends")}}</span> <b class="caret mdi mdi-chevron-down"></b>
          </a>
          
          <ul class="collapse" id="Spends-dropdown" data-parent="#sidebar-menu">
            <div class="sub-menu">
            @auth
            @role(['Super Admin','Admin'])
              <li>
                <a href="{{route('spendsList')}}">
                  <span class="nav-text">{{ __("trans.All Spends")}}</span>
                </a>
              </li>
              @endrole
              @endauth
              <li>
                <a href="{{route('createSpendForm')}}">
                  <span class="nav-text">{{ __("trans.Spends Form")}}</span>
                </a>
              </li>
              
              <li>
                <a href="{{route('spendReport')}}">
                  <span class="nav-text">{{ __("trans.Reports")}}</span>
                </a>
              </li>
            </div>
          </ul>
        </li>
        @auth
        @role(['Super Admin','Admin'])
        <li>
          <a class="sidenav-item-link" href="{{ route('usersList') }}">
            <i class="mdi mdi-account-multiple"></i>
            <span class="nav-text">{{ __("trans.Users")}}</span>
          </a>
        </li>
          @endrole
          @endauth
        
      </ul>
    </div>
  </div>
</aside>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
              <li class=" treeview">
                <a href="{{ route('admin.fac_management') }}">
                  <i class="fa fa-sitemap"></i> <span>Manage Facilities</span>
                </a>
              </li>
              <li class=" treeview">
                <a href="{{ route('admin.dept_management') }}">
                  <i class="fa fa-sitemap"></i> <span>Manage Departments</span>
                </a>
              </li>

            <li><a href="{{ route('admin.std_management') }}"><i class="fa fa-users"></i>Import Student Data</a></li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
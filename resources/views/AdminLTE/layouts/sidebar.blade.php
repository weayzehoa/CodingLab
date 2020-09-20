  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('AdminLTE/index2') }}" class="brand-link">
          <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav id="sidebar" class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon classwith font-awesome or any other icon font library -->
                  <li class="nav-item has-treeview ">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/index1') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Dashboard v1</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/index2') }}" class="nav-link ">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Dashboard v2</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/index3') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Dashboard v3</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('AdminLTE/widgets') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Widgets
                              <span class="right badge badge-danger">New</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Charts
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/chartjs') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>ChartJS</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/flot') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Flot</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tree"></i>
                          <p>
                              UI Elements
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/general') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>General</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/buttons') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Buttons</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/sliders') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Sliders</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/modals') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Modals & Alerts</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/navbar') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Navbar & Tabs</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/timeline') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Timeline</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/ribbons') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ribbons</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Forms
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/formgeneral') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>General Elements</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/advanced') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Advanced Elements</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/editors') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Editors</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/validation') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Validation</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              Tables
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/simple') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Simple Tables</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/data') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>DataTables</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/jsgrid') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>jsGrid</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                      <a href="calendar" class="nav-link">
                          <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              Calendar
                              <span class="badge badge-info right">2</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('AdminLTE/gallery') }}" class="nav-link">
                          <i class="nav-icon far fa-image"></i>
                          <p>
                              Gallery
                          </p>
                      </a>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-envelope"></i>
                          <p>
                              Mailbox
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/mailbox') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Inbox</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/compose') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Compose</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/read-mail') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Read</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Pages
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/invoice') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Invoice</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/profile') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Profile</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/e-commerce') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>E-commerce</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/projects') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Projects</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/project-add') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Project Add</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/project-edit') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Project Edit</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/project-detail') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Project Detail</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('AdminLTE/contacts') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Contacts</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">MISCELLANEOUS</li>
                  <li class="nav-item">
                      <a href="https://adminlte.io/docs/3.0" class="nav-link">
                          <i class="nav-icon fas fa-file"></i>
                          <p>Documentation</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

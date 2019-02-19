<header class="main-header">
	<!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    	<!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning invite-count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="invite-count"></span> notification</li>
              <li>
                  <ul class="menu" id="invite-loop">
                      <!-- Content go here -->
                  </ul>
              </li>
            </ul>
          </li>

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success message-count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="message-count"></span> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="message-loop">
                    <!-- Content go here -->
                </ul>
              </li>
              <li class="footer"><a href="#"></a></li>
            </ul>
          </li>

          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="javascript:void(0)" type="submit" onclick="document.querySelector('#logout').submit()">
              <i class="glyphicon glyphicon-off"></i>
            </a>
            <form action="{{ route('logout') }}" method ="POST" id="logout">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </nav>

</header>
<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ url('dashboard') }}" class="navbar-brand"><b>{{ env('APP_NAME') }}</b> TASK</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
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
            <!-- /.messages-menu -->
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ is_null(auth()->user()->avatar_url) ? asset('images/user4-128x128.jpg') : asset(auth()->user()->avatar_url) }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->middle_name }} {{ auth()->user()->last_name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ is_null(auth()->user()->avatar_url) ? asset('images/user4-128x128.jpg') : asset(auth()->user()->avatar_url) }}" class="img-circle" alt="User Image">

                  <p>
                    {{ auth()->user()->first_name }} {{ auth()->user()->middle_name }} {{ auth()->user()->last_name }} -

                    @foreach(auth()->user()->getRoleNames() as $role)
                      {{ $role }}
                    @endforeach

                    <small>Member since {{ auth()->user()->created_at->diffForHumans() }}</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="javascript:void(0);">
                        Projects
                        <span class="label label-warning ">{{ count(auth()->user()->boards) }}</span>
                      </a>
                    </div>
                    @if(auth()->user()->hasRole(['Developer','Sinior Developer']))
                      <div class="col-xs-4 text-center">
                        <a href="#">
                            # Skills <br />
                            <span class="label label-warning invite-count">{{ count(auth()->user()->skills) }}</span>
                        </a>
                      </div>
                    @endif
                    <div class="col-xs-4 text-center">
                      <a href="#">
                        Budget <br />
                        $ {{ auth()->user()->total_budget }}
                      </a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('user/profile') }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                      <form action="{{ route('logout') }}" method="POST" id="logout">
                          @csrf
                      </form>
                    <a href="javascript:void(0);" class="btn btn-default btn-flat" onclick="document.querySelector('#logout').submit()">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
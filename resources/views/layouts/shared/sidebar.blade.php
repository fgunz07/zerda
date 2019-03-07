<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src='{{ asset(auth()->user()->avatar_url) }}' class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ auth()->user()->first_name }} {{ auth()->user()->middle_name }} {{ auth()->user()->last_name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="">
        <a href="{{ url('dashboard') }}">
          <i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <li class="">
        <a href="{{ url('user/profile') }}">
          <i class="glyphicon glyphicon-user"></i> <span>Profile</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <li class="">
        <a href="{{ url('/messages/inbox') }}">
          <i class="glyphicon glyphicon-envelope"></i> <span>Inbox</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <li class="">
        <a href="{{ url('/todo-app/boards') }}">
          <i class="glyphicon glyphicon-tasks"></i> <span>Projects</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      {{-- @hasanyrole('Senior Developer|Developer')

        <li class="">
          <a href="{{ url('skills-list') }}">
            <i class="glyphicon glyphicon-th-list"></i> <span>Skills</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      @endhasanyrole --}}
      
      <li class="">
          <a href="{{ url('ratingdesc-list') }}">
            <i class="glyphicon glyphicon-list"></i> <span>Ratings</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

      {{-- @hasanyrole('Senior Developer|Developer') 
      <li class="">
        <a href="{{ url('profile') }}">
          <i class="glyphicon glyphicon-user"></i> <span>Profile</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      @endhasanyrole --}}
      

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
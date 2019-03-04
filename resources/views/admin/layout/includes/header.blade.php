<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">後台管理</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
  </ul>
</nav>

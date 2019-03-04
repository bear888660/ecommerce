<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            @if ($nav_managements)
                @foreach($nav_managements as $nav_management)
                    <li class="nav-item">
                        <a class="nav-link" href="{{$nav_management->resource}}">
                        <span data-feather="file"></span>
                        {{$nav_management->name}}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
      </div>
    </nav>
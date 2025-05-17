<div class="flex-column text-bg-dark flex-shrink-0 p-3 nav-cel" style="width: 100%; background: transparent!important;">
  <ul class="nav nav-pills flex-column mb-auto" style="position: relative">
      <button type="button" class="link-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"  style="text-align: left; ">{{-- Fechar menu ao ir para link --}}
        <li class="nav-item">
            <a id="link-home" class="nav-link" href="{{route('index')}}">
                Smart Job
            </a>
        </li>
      </button>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" style="position: absolute; right: 0; top: 50%; transform: translateY(-60%)"></button>
    </a>
    <hr>
  </ul>

    <ul class="nav nav-pills flex-column mb-auto">
        <button type="button" class="link-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"  style="text-align: left; ">{{-- Fechar menu ao ir para link --}}
            <li class="nav-item">
                <a id="link-home" class="nav-link" href="{{route('index')}}">
                    Home
                </a>
            </li>
        </button>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Customers
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
  </div>
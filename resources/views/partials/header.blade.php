{{-- <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fas fa-shopping-cart"></i> Shopping Cart</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> User Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">User Account</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
</nav> --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('product.index') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('product.shoppingCart') }}">
            <i class="fas fa-shopping-cart"></i>  Shopping Cart
          <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}
          </span>
        </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>  User Management
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if(Auth::check())
              <a class="dropdown-item" href="{{ route('user.profile') }}">User Profile</a>
              <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
            @else
              <a class="dropdown-item" href="{{ route('user.login') }}">Log In</a>
              <a class="dropdown-item" href="{{ route('user.signup') }}">Sign Up</a>
              {{-- <div class="dropdown-divider"></div> --}}
            @endif


          </div>
        </li>
      </ul>
    </div>
  </nav>

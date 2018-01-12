<header>
  <div class="container-header">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-6 logo-wrap">
          <h1>
            <a href="/">
              <img src="{{asset('images/logo.png')}}" alt="FreeTSReviews.com" title="FreeTSReviews.com">
            </a>
          </h1>
        </div>
        <div class="col-md-6 col-sm-12 order-md-1 order-12 search-form-conatainer">
          <form class="align-items-center search-form" method="GET" action="{{url('/')}}" id="searchForm">
            <div class="form-group row align-items-center mb10 rmb0">
            <div class="col-8 rpd0">
              <input id="search" value="@yield('searchNumber')" type="text" name="search"  oninput="this.value = this.value.replace(/[^0-9.)(-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control search-input rounded-20" id="" placeholder="Enter Number...">
            </div>
            <div class="col-4">
              <button type="submit" class="search-btn">SEARCH</button>
            </div>
            </div>
          </form>
        </div>
        <div class="col-md-3 col-sm-6 col-6 auth-container text-right order-md-12">
          <span class="padd-h-10 auth-link">
            <i class="fa fa-sign-in" aria-hidden="true"></i>

                @if (Auth::guest())
                    <a href="{{ url('auth/login') }}">Login</a>

                    @else
                        <a href="{{ url('auth/logout') }}">
                            Logout
                        </a>
                @endif

          </span>
          <span class="padd-h-10 auth-link">
            <i class="fa fa-user" aria-hidden="true"></i>
                            @if (Auth::guest())
                            <a href="{{ url('auth/register') }}">JOIN FREE</a>
                @endif

          </span>
        </div>
      </div>      
    </div>
  </div>
</header>
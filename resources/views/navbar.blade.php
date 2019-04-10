<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
    <a class="navbar-brand card bg-dark" href="{{ url('/') }}">
      <img src="{{ asset('img/logo-full.png') }}" alt="proven logo">
      {{-- {{ config('app.name') }} --}}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ trans('messages.categories') }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('category-list') }}">List</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('category-create') }}">Create</a></li>
            <li><a class="dropdown-item" href="{{ route('category-find') }}">Find & Edit</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ trans('messages.products') }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('product-list') }}">List</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('product-create') }}">Create</a></li>
            <li><a class="dropdown-item" href="{{ route('product-find') }}">Find & Edit</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Book Management System</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="{{ route('logout') }}">Logout</a></li>
      <li><a href="{{route('category.create')}}">Create Category</a></li>
      <li><a href="{{route('book.list')}}">Book List</a></li>
      <li><a href="{{route('log.activity.list')}}">Log List</a></li>
      @if (Route::current()->getName() == 'book.list')
      <li><a href="{{route('book.create')}}">Create Book</a></li>
      @endif
    </ul>
  </div>
</nav>

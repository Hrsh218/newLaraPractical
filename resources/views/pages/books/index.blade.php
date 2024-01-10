@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Book List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Author Name</th>
                    <th>Published Date</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($books))
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->author_name }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($book->published_date)) }}</td>
                            <td><img src="{{ env('APP_URL') }}/storage/images/{{ $book->image }}" width="100"
                                    height="100" /></td>
                            <td>
                                <a href="{{ route('book.edit', $book->id) }}">Edit<a>
                                        <form method="POST" action="{{ route('book.delete', $book->id) }}">
                                            @csrf
                                            <button id="GFG_UP">Delete</button>
                                        </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $books->links() }}

    </div> <script>
        $("#GFG_UP").
                text("Delete");

            $('#GFG_UP').on('click', function () {
                return confirm('Are you sure?');
            });
    </script>
@endsection

@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Create Book</h2>
        <form method="POST" action="{{route('book.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                @if ($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="pwd">Category:</label>
                <select class="form-control" name="category" id="cars">
                    <option value="">Select your category</option>
                    @if (isset($categories) || !empty($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif

                </select>
                @if ($errors->has('category'))
                    <div class="error">{{ $errors->first('category') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label>Author Name</label>
                <input type="text" class="form-control" id="author_name" placeholder="Enter Author Name"
                    name="author_name">
                @if ($errors->has('author_name'))
                    <div class="error">{{ $errors->first('author_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label>Publish Date</label>
                <input type="date" class="form-control" id="published_date" name="published_date">
                @if ($errors->has('published_date'))
                    <div class="error">{{ $errors->first('published_date') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($errors->has('image'))
                    <div class="error">{{ $errors->first('image') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection

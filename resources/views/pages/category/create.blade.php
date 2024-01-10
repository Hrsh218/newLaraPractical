@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Create Category</h2>
        <form method="POST" action="{{route('category.store')}}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                @if ($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="pwd">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
                @if ($errors->has('description'))
                    <div class="error">{{ $errors->first('description') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection

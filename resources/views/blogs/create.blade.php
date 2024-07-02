@extends('app')
@section('content')
    <form method="post" action="{{route('blog.store')}}">
        @csrf
        <div class="m-4">
            <h2>Create blog</h2>
            <div class="mb-3">
                <label for="a" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="a" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <a class="btn btn-secondary" href="{{route('blog.index')}}">Back</a>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>

@endsection

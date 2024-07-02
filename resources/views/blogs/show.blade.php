@extends('app')
@section('content')
    <div class="m-4">
        <h3>{{$blogContent->title}}</h3>
        <div class="card card-body">
            {{$blogContent->content}}
        </div>
        <div class="pt-2">
            <a href="{{route('blog.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection

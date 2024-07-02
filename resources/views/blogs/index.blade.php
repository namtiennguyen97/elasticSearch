
@extends('app')
@section('content')
    <style>
        .demo-content{
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 1200px;
        }
    </style>
    <a href="{{route('blog.create')}}" class=" btn btn-success mb-3"><i class="fa-solid fa-plus"></i></a>
{{--    @if($blog)--}}
{{--    @endif--}}
    <ol class="list-group list-group-numbered">
        @foreach($blogs as $blog)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a href="{{route('blog.show', $blog['id'])}}">{{$blog['title']}}</a></div>
                    <span class="demo-content">{{$blog['content']}}</span>
                </div>
{{--                <span class="badge bg-primary rounded-pill">14</span>--}}
                <a href="{{route('blog.delete', $blog['id'])}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </li>
        @endforeach
{{--        {{$blogs->links()}}--}}
    </ol>
@endsection

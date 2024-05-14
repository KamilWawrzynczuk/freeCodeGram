@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 rounded-circle p-3">
            <img src="/svg/freeCodeCampLogo.svg" />
        </div>
        <div class="col-9 p-3">
            <div class='d-flex justify-content-between'>
                <div><h1>{{ $user->username }}</h1></div>
                <button class="btn btn-primary"><a href="../p/create">New post</a></button>
            </div>
            <div class="d-flex">
                <div class="px-1"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="px-1"><strong>123</strong> followers</div>
            </div>
            <div>
                <div class="font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url }}</a></div>
            </div>
        </div>
    </div>



    <div class="row pt-4">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                <img class="w-100" src="../storage/{{ $post->image }}" />
            </a>
            </div>
        @endforeach
    </div>

</div>
@endsection

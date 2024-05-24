@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <image src="{{ asset('storage/'. $post->image) }}" class="w-100"/>
         </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <image src="{{ asset('storage/'. $post->user->profile->image) }}" class="w-100 rounded-circle p-1" style="max-width: 50px"/>
                <h5><a style="color: black;" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a></h5> <a class="p-2" href="">Folow</a>
            </div>
            <hr/>
            <span><a  style="color: black;" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a></span>  <span>{{ $post->caption }}</span>
         </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row mb-3">
            <h2>Edit profile</h2>
            <div class="col-8 offset-2 d-flex">
                <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>

                <input
                    id="title"
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    name="title"
                    value="{{ old('title') ?? $user->profile->title }}"
                    autocomplete="title"
                    autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
               <div class="col-8 offset-2 d-flex">
                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                <input
                    id="description"
                    type="text"
                    class="form-control @error('description') is-invalid @enderror"
                    name="description"
                    value="{{ old('description') ?? $user->profile->description }}"
                    autocomplete="description"
                    autofocus>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

               <div class="col-8 offset-2 d-flex">
                <label for="url" class="col-md-4 col-form-label text-md-end">Adress url</label>

                <input
                    id="url"
                    type="text"
                    class="form-control @error('url') is-invalid @enderror"
                    name="url"
                    value="{{ old('url') ?? $user->profile->url }}"
                    autocomplete="url"
                    autofocus>

                @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>

        <div class="row">
            <label for="image" class="col-md-4 col-form-label text-md-end">Profile Image</label>
            <input type="file" class="form-control-file" id="image" name="image" />
            @error('image')
                    <strong>{{ $message }}</strong>
            @enderror
        </div>

        <div class="row">
            <button class="btn btn-primary py-2">Save profile</button>
        </div>
    </form>
</div>
@endsection

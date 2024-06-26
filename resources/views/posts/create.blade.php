@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row mb-3">
            <h2>Add new Post</h2>
            <div class="col-8 offset-2 d-flex">
                <label for="caption" class="col-md-4 col-form-label text-md-end">Post Caption</label>

                <input
                    id="caption"
                    type="text"
                    class="form-control @error('caption') is-invalid @enderror"
                    name="caption"
                    value="{{ old('caption') }}"
                    autocomplete="caption"
                    autofocus>

                @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>

        <div class="row">
            <label for="image" class="col-md-4 col-form-label text-md-end">Post Image</label>
            <input type="file" class="form-control-file" id="image" name="image" />
            @error('image')
                    <strong>{{ $message }}</strong>
            @enderror
        </div>

        <div class="row">
            <button class="btn btn-primary py-2">Add new post</button>
        </div>
    </form>
</div>
@endsection

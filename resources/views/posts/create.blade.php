@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="/p" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-8">
                    <h1>Add new post</h1>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label ">{{ __('Post Caption') }}</label>

                        <input id="name"
                               type="text"
                               class="form-control @error('caption') is-invalid @enderror"
                               name="caption"
                               value="{{ old('caption') }}"
                               autocomplete="name" autofocus>

                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label">Post Image</label>
                        <input type="file" class="form-control-file  @error('image') is-invalid @enderror" id="image" name="image" />
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <button class="btn btn-primary">Add new post</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

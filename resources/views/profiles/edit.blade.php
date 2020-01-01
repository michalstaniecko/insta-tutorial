@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row justify-content-center">
                <div class="col-8">
                    <h1>Edit profile</h1>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label ">{{ __('Title') }}</label>

                        <input id="title"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               value="{{ old('title') ?? $user->profile->title }}"
                               autocomplete="name" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label ">{{ __('Description') }}</label>

                        <input id="description"
                               type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description"
                               value="{{ old('description') ?? $user->profile->description }}"
                               autocomplete="name" autofocus>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label ">{{ __('URL') }}</label>

                        <input id="url"
                               type="text"
                               class="form-control @error('url') is-invalid @enderror"
                               name="url"
                               value="{{ old('url') ?? $user->profile->url }}"
                               autocomplete="name" autofocus>

                        @error('url')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                        <input type="file" class="form-control-file  @error('image') is-invalid @enderror" id="image" name="image" />
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

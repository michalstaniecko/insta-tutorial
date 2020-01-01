@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-5 ">
            <div class="col-3">
                <img class="rounded-circle w-100"
                     src="{{ $user->profile->profileImage() }}"/>
            </div>
            <div class="col-9">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">

                        <div class="h4">
                            {{ $user->username }}
                        </div>
                        <follow-botton user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-botton>
                    </div>
                    @can('update', $user->profile)
                        <a href="/p/create">Add new post</a>
                    @endcan
                </div>
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan
                <div class="d-flex">

                    <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                    <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                    <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">
                    {{ $user->profile->title }}
                </div>
                <div>
                    {{ $user->profile->description }}
                </div>
                <div>
                    <a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            @forelse($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">

                        <img class="w-100"
                             src="/storage/{{ $post->image }}"/>
                    </a>
                </div>
            @empty
                No images
            @endforelse
        </div>
    </div>
@endsection

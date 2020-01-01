@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                @forelse($posts as $post)

                    <div class="row">
                        <div class="col">

                            <a href="/profile/{{$post->user->id}}">

                                <img class="w-100" src="/storage/{{ $post->image }}"/>
                            </a>
                        </div>
                    </div>
                    <div class="row pt-2 pb-4">
                        <div class="col">
                            <div>
                                <p>
                        <span class="font-weight-bold ">
                            <a href="/profile/{{ $post->user->id }}"
                               class="text-dark">{{ $post->user->username }}</a>
                        </span>
                                    {{ $post->caption }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty

                    No Following profiles

                @endforelse
            </div>
        </div>
        <div class="row">
            <div class="col-auto mx-auto ">
                {{ $posts->links() }}
            </div>
        </div>

    </div>


@endsection

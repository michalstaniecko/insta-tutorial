@foreach($comments->sortByDesc('created_at')->values()->all() as $comment )
<div class="{{ empty($nested) ? 'pb-5' : null  }}">

    <div>
        <strong>{{ $comment->user->username }}</strong>
        {{ $comment->comment }}

        <div>

            <small>{{ $comment->created_at }}</small>
        </div>
        @if (empty($nested))
            @include('comments.partials._form', ['label'=>'Reply'])
        @endif

    </div>
    <div class="pl-5">


        @include('comments.partials._comments', [
    'comments'=>$comment->replies,
    'nested' => true
    ])
    </div>
</div>

@endforeach

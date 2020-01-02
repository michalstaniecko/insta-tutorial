<div class="pb-3">

    <form action="/p/{{ $post->id }}/comments" method="post">
        <input type="hidden" name="parent_id" value="{{ $comment->id ?? '' }}"  />
        @csrf
        <div class="form-group row">
            <div class="col">
                <label for="content" class="col-md-4 col-form-label ">{{ $label ?? 'Comment'  }}:</label>

                <textarea id="content"
                          type="text"
                          class="form-control @error('content') is-invalid @enderror"
                          name="content"
                          value="{{ old('content') }}"
                          autocomplete="off" autofocus>
                                </textarea>

                @error('content')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Send {{ $label ?? 'Comment' }}</button>
    </form>
</div>

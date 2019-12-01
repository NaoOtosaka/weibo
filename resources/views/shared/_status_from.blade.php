<form action="{{ route('statuses.store') }}" method="post">
    @include('shared._errors')
    {{ csrf_field() }}
    <textarea class="form-control" name="content" placeholder="有什么想说的嘛？" rows="3">{{ old('content') }}</textarea>
    <div class="text-right">
        <button type="submit" class="btn btn-primary mt-3">
            Biu~
        </button>
    </div>
</form>

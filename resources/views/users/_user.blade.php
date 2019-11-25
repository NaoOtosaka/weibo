<div class="list-group-item">
    <img class="mr-3" src="{{ $user->headPic() }}" alt="{{ $user->name }}" width="32">
    <a href="{{ route('users.show', $user) }}">
        {{ $user->name }}
    </a>

    @can('destroy', $user)
        <form method="post" class="float-right" action="{{ route('users.destroy', $user->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                除名！
            </button>
        </form>
    @endcan
</div>

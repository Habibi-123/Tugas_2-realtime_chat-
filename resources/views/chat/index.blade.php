<h2>List User</h2>

@foreach($users as $user)
    <p>
        <a href="{{route('chat.room', $user->id) }}">
            {{ $user->name }}
        </a>
    </p>
@endforeach
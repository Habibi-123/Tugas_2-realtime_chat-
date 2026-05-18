@php
    $isOnline = $user->last_seen && $user->last_seen->gt(now()->subMinutes(2));
@endphp

<p>
    <a href="{{ route('chat.room', $user->id) }}">
        {{ $user->name }}
    </a>

    @if($isOnline)
        <span style="color: green;">
            🟢 Online
        </span>
    @else
        <span style="color: gray;">
            ⚫ Offline
        </span>
    @endif
</p>
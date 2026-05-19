<!DOCTYPE html>
<html>
<head>
    <title>List User</title>

    <style>

        body{
            font-family: Arial;
            background: #ece5dd;
            padding: 30px;
        }

        .container{
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        .user{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            background: #f5f5f5;
        }

        .user a{
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .online{
            color: green;
            font-size: 14px;
        }

        .offline{
            color: gray;
            font-size: 14px;
        }

    </style>
</head>

<body>

<div class="container">

    <h2>List User</h2>

    @foreach($users as $user)

        @php
            $isOnline = $user->last_seen &&
                         $user->last_seen->gt(now()->subseconds(10));
        @endphp

        <div class="user">

            <a href="{{ route('chat.room', $user->id) }}">
                {{ $user->name }}
            </a>

            @if($isOnline)

                <span class="online">
                    🟢 Online
                </span>

            @else

                <span class="offline">
                    ⚫ Offline
                </span>

            @endif

        </div>

    @endforeach

</div>

<script>

setInterval(() => {
    location.reload();
}, 5000);

</script>

</body>
</html>
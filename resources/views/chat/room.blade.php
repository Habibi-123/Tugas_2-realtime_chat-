<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>

    <style>

        body{
            font-family: Arial;
            background: #ece5dd;
            padding: 20px;
        }

        .chat-box{
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }

        .message{
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            width: fit-content;
            max-width: 70%;
        }

        .me{
            background: #dcf8c6;
            margin-left: auto;
            text-align: right;
        }

        .other{
            background: #f1f1f1;
        }

        form{
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        input{
            flex: 1;
            padding: 10px;
        }

        button{
            padding: 10px 20px;
            cursor: pointer;
        }

    </style>
</head>

<body>

<div class="chat-box">

    <h2>
        Chat dengan {{ $user->name }}
    </h2>

    <hr>

    @foreach($messages as $msg)

        <div class="message {{ $msg->sender_id == auth()->id() ? 'me' : 'other' }}">

            <b>
                {{ $msg->sender_id == auth()->id() ? 'You' : $user->name }}
            </b>

            <br>

            {{ $msg->message }}

        </div>

    @endforeach

    <form action="{{ route('chat.send') }}" method="POST">

        @csrf

        <input type="hidden" name="receiver_id" value="{{ $user->id }}">

        <input type="text" name="message" placeholder="Tulis pesan..." required>

        <button type="submit">
            Kirim
        </button>

    </form>

</div>

</body>
</html>
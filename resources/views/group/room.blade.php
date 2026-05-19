<!DOCTYPE html>
<html>
<head>
    <title>Group Room</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
            max-width: 700px;
            margin: auto;
            height: 500px;
            overflow-y: auto;
        }

        .message{
            background: #f1f1f1;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
        }

        form{
            margin-top: 20px;
            display: flex;
            gap: 10px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
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

<div class="chat-box" id="chat-box">

    <h2>
        Group: {{ $group->name }}
    </h2>

    <hr>

    @foreach($messages as $msg)

        <div class="message">

            <b>
                {{ $msg->user->name }}
            </b>

            <br>

            {{ $msg->message }}

        </div>

    @endforeach

</div>

<form action="{{ route('groups.send') }}" method="POST">

    @csrf

    <input type="hidden" name="group_id" value="{{ $group->id }}">

    <input type="text" name="message" placeholder="Tulis pesan..." required>

    <button type="submit">
        Kirim
    </button>

</form>
<script>

document.addEventListener("DOMContentLoaded", function () {

    console.log("Realtime group aktif");

    Echo.channel('group.{{ $group->id }}')
    .listen('.group.message', (e) => {

        console.log(e);

        let box = document.getElementById('chat-box');

        let html = `
            <div class="message">

                <b>${e.message.user.name}</b>

                <br>

                ${e.message.message}

            </div>
        `;

        box.innerHTML += html;

        box.scrollTop = box.scrollHeight;
    });

});

</script>

</body>
</html>
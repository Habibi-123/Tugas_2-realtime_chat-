<!DOCTYPE html>
<html>
<head>
    <title>Group Chat</title>

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

        .group{
            padding: 15px;
            margin-bottom: 10px;
            background: #f5f5f5;
            border-radius: 10px;
            transition: 0.3s;
        }

        .group:hover{
            background: #e0e0e0;
        }

        .group a{
            text-decoration: none;
            color: black;
            font-weight: bold;
            display: block;
            width: 100%;
        }

    </style>
</head>

<body>

<div class="container">

    <h2>Group Chat</h2>

    @foreach($groups as $group)

        <div class="group">

            <a href="{{ route('groups.chat', $group->id) }}">

                {{ $group->name }}

            </a>

        </div>

    @endforeach

</div>

</body>
</html>
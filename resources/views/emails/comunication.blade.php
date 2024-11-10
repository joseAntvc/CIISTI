<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5e5e5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            max-width: 600px;
            margin: auto auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: rgb(4, 163, 86);
        }
        p {
            line-height: 1.6;
        }
        .message {
            background-color: #e5e5e5;
            border-left: 4px solid rgb(4, 163, 86);
            padding: 10px 15px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
        .footer a {
            color: rgb(4, 163, 86);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mensaje del CIISTI</h2>
        <h3>Asunto: {{ $users['title'] }}</h3>
        <p>Se a dejado el siguiente mensaje:</p>
        <div class="message">
            <p>{{ $users['description'] }}</p>
        </div>
        <div class="footer">
            <p>Este es un mensaje automático. Si tienes alguna duda, <a>contáctanos</a>.</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Congratulation</h2>
    <p>{{ $detail['name'] }} is created</p>
    <a href="http://127.0.0.1:8000/api/user/verify/{{ $detail['id'] }}">Cliick Here to verify</a>
</body>

</html>
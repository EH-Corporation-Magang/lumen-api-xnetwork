<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @foreach($user as $s)

    <h1>{{$s->username}}</h1>
    <h1>{{$s->email}}</h1>
    <h1>{{$s->password}}</h1>
    <h1>{{$s->token}}</h1>
    <img src="{{asset($s->gambar_user)}}" alt="img_user">

    @endforeach
</body>

</html>

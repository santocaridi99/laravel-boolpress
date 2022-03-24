{{-- mail relativa alla sezione contatti --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Nuovo Messaggio ricevuto</h1>
    <div><h4>Da: {{$newContactInfo->name}}</h4></div>
    <div><h4>address:{{$newContactInfo->email}}</h4></div>
    <div><h4>{{$newContactInfo->message}}</h4></div>
</body>
</html>
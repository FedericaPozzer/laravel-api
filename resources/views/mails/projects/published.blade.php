<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- non posso includere BS perchè le mail non lo leggono :( (non leggono i link) --}}

    <style>
        body {
            background-color: lightblue;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <h1>New project published!</h1>

    <h2>{{ $project->title }}</h2>

    <p>{{ $project->getAbstract(50) }}</p>
</body>
</html>
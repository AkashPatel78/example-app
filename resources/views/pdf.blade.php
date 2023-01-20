<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .container {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
        }
    </style>
</head>

<body>
    <h1>View And Download Pdf</h1>
    @foreach ($book as $row)
        <div class="container">

            <iframe src="{{ asset('storage/pdf/' . $row->pdf) }}" title="description" class="responsive-iframe"></iframe>
        </div>
    @endforeach

</body>

</html>

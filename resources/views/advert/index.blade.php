<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body class="antialiased">
<div class="container">
    <div class="title-block mt-4">
        <h1><b>All adverts</b></h1>
    </div>
    @foreach ($adverts as $advert)
        <div class="d-flex custom-block mb-4 p-2">
            <div class="images-block d-flex">
                @if (count($advert->images) === 0)
                    <div class="no-images-stub mr-4">
                        No images
                    </div>
                @endif
                @foreach ($advert->images as $image)
                    @if ($image->status === \App\Models\Image::PENDING_STATUS)
                        <div class="pending-image-stub mr-2">
                            Loading
                        </div>
                    @elseif ($image->status === \App\Models\Image::READY_STATUS)
                        <img src="{{ \App\Services\ImageService::getPublicPath($image) }}"
                             alt="Advert image"
                             class="image mr-2">
                    @endif
                @endforeach
            </div>
            <div class="content-block">
                <h5 class="card-title">{{ $advert->title }}</h5>
                <p class="card-text">{{ $advert->description }}</p>
            </div>
        </div>
    @endforeach

    {{ $adverts->links() }}
</div>
</body>
</html>

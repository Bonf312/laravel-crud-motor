<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Data Motor')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<style>
    body {
        background-color: #f5f7fb;
    }

    .motor-card {
        border-radius: 14px;
        overflow: hidden;
        transition: transform 0.2s ease,
                    box-shadow 0.2s ease;
    }

    .motor-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.10)
            !important;
    }

    .motor-image,
    .motor-image-placeholder {
        width: 100%;
        height: 190px;
    }

    .motor-image {
        object-fit: contain;
        padding: 12px;
        background: #ffffff;
    }

    .motor-image-placeholder {
        background: #e9ecef;
    }

    .card {
        border-radius: 12px;
    }
</style>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('motors.index') }}">
            CRUD Data Motor
        </a>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

</body>
</html>
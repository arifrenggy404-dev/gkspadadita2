<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GKS Padadita') - SI GKS Padadita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f4f4f4; font-family: Arial, sans-serif; }
    </style>
    @yield('styles')
</head>
<body>

@include('public.layouts.navbar')

<main>
    @yield('content')
</main>

<footer style="background:#003366;" class="text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1 fw-bold">✝ GKS Padadita</p>
        <p class="mb-0 opacity-75 small">Menjadi Terang dan Garam Bagi Dunia</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
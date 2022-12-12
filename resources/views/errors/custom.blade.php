<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bordash - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
</head>
<body class="error-page bg-white">

<div>
    <div>
        @foreach (str_split($exception->getStatusCode()) ?? str_split(404) as $item)
        <span class="error-page-item font-weight-bold">{{ $item }}</span>
        @endforeach
    </div>
    <h4 class="mb-0 text-muted font-weight-normal">{{ $exception->getMessage() ?? 'Upps! Page Error!' }}</h4>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
</div>

</body>
</html>

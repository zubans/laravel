<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>
<body class="bg-dark text-white">
<div class="d-flex flex-column flex-md-row align-items-center bg-dark pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-white text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" role="img"><title>Иконка</title><path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"></path></svg>
        <span class="fs-4">Иконка</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-white" href="/">Главная</a>
        <a class="me-3 py-2 text-white" href="/about">О нас</a>
      </nav>
      <a class="btn btn-warning" href="review">Отзывы</a>
    </div>
<div class="container">
@yield('main_content') 
</div>
   
</body>
</html>

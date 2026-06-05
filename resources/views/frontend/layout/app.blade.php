<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Sarab">
    <meta name="description" content="Sarab - Fast Food & Restaurant HTML Template">
    <title>Sarab - Fast Food & Restaurant HTML Template</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
    <!-- Bootstrap 5.3 -->
    <link href="{{asset('template/sarab')}}/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- AOS Animate on Scroll -->
    <link href="{{asset('template/sarab')}}/css/aos.css" rel="stylesheet"/>
    <!-- Swiper -->
    <link href="{{asset('template/sarab')}}/css/swiper-bundle.min.css" rel="stylesheet"/>
    <!-- all min css -->
    <link rel="stylesheet" href="{{asset('template/sarab')}}/css/all.min.css"/>
    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{asset('template/sarab')}}/css/magnific-popup.css"/>
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('template/sarab')}}/css/style.css" />
</head>


<body class="index-page">

  <header id="header" class="header d-flex flex-column fixed-top">
   @include('frontend.layout.header')
  </header>

  <main class="pt-5 mt-5">
    @yield('content')
  </main>

  <footer id="footer" class="footer position-relative light-background">
   @include('frontend.layout.footer')
  </footer>

  <!-- Scroll Top -->
       <script src="{{asset('template/sarab')}}/js/jquery-3.7.1.min.js"></script>
      <!-- Bootstrap 5 -->
      <script src="{{asset('template/sarab')}}/js/bootstrap.bundle.min.js"></script>
      <!-- AOS -->
      <script src="{{asset('template/sarab')}}/js/aos.js"></script>
      <!-- Swiper -->
      <script src="{{asset('template/sarab')}}/js/swiper-bundle.min.js"></script>
      <!-- CounterUp -->
      <script src="{{asset('template/sarab')}}/js/jquery.magnific-popup.min.js"></script>
      <!-- Main js -->
      <script src="{{asset('template/sarab')}}/js/main.js"></script>
</body>

</html>
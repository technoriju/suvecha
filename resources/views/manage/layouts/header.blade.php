<!DOCTYPE html>
<html lang="en">

<head>
    @stack('title')
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ url('assets/manage/images/favi.ico') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ url('assets/manage/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ url('assets/manage/plugins/animation/css/animate.min.css') }}">
    <!-- morris css -->
    <link rel="stylesheet" href="{{ url('assets/manage/plugins/chart-morris/css/morris.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ url('assets/manage/css/style.css') }}">
    <script src="{{ url('assets/manage/js/sweetalert.min.js') }}"></script>
    @stack('style')
</head>

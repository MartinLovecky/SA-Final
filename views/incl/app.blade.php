<!DOCTYPE html> 
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ $selector->title }}</title>
    <meta property="og:type" content="website">
    <meta name="description" content="Adventure|Sci-fi|Fantasy story where the protagonist discovers that he lives in a much more mysterious and amazing world ">
    <link rel="icon" type="image/png" sizes="256x256" href="@asset("image/android-chrome-256x256.png")">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.1.3/dist/cosmo/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie" >
    <link rel="stylesheet" type="text/css" href="@asset("css/styles.min.css")" >
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/full-all/ckeditor.js"></script>
</head>
<body>

@isset($selector->fristQueryValue)
    @php  $message->getQueryMessage(); @endphp
@endisset

@php $message->getMessage(); @endphp

@if($message->isNotEmpty())
    @component('component.message', ['message'=>$message])
        <strong>Whoops!</strong> Something went wrong! (the code is right btw)
    @endcomponent
@endif

@yield($selector->viewName)

@include('incl.footer',['selector'=>$selector])

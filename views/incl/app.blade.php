<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Author: Sensei, Příběh, SCI-FI">
    <title>{{ $selector->title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="@asset("css.Form-Dark.min.css")"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://sadventure.xf.cz/public/css/Login-Form-Dark.css">
    <link rel="stylesheet" type="text/css" href="http://sadventure.xf.cz/public/css/project-horizont.min.css">
    <link rel="stylesheet" type="text/css" href="http://sadventure.xf.cz/public/css/styles.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js" ></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            alert('Thanks ' + document.getElementById('field').value);
        }
        function validate(event){
            event.preventDefault();
            if(!document.getElementById('filed').value){
                alert('You must add text to required field');
            }else{
                grecaptcha.execute();
            }
        }
        function onload(){
            var element = document.getElementById('submit');
            element.onclick = validate(element);
        }
    </script>    
</head>
<body>
@if ($message->isNotEmpty())

{!! $message->display() !!}
 
@elseif(isset($_SESSION['message']))

{!! $message->display($_SESSION['message'],$_SESSION['style']) !!}
    
@endif        
@component($selector->viewName)
@endcomponent
@include('incl.footer',['selector'=>$selector])

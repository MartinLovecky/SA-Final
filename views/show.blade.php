@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@if (!isset($selector->article) && !isset($selector->page))
    @include('incl.articles',['article'=>$article])    
@else
    @include('incl.story',['article'=>$article, 'wrapper'=>$wrapper,'selector'=>$selector])
@endif
@endsection
@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)

@include('incl.story',['article'=>$article, 'wrapper'=>$wrapper,'selector'=>$selector])
{{-- Not sure wats going on 
@if (!isset($selector->article) && !isset($selector->page))
    @include('incl.articles',['articleController'=>$articleController])    
@else
    @include('incl.story',['articleController'=>$articleController,'wrapper'=>$wrapper])
@endif--}}
@endsection
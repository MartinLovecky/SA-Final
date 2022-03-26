@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@if (!isset($selector->article) && !isset($selector->page))
    @include('incl.articles',['articleController'=>$articleController])    
@else
    @include('incl.story')
@endif
@endsection
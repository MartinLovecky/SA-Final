@extends('incl.app',['message'=>$message,'selector'=>$selector])
@section($selector->viewName)
@if (!isset($selector->article) && !isset($selector->page))
    @include('incl.articles',['articleController'=>$articleController])    
@else
    @include('incl.story')
@endif
@endsection
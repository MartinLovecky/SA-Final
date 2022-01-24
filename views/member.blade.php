@extends('incl.app',['message'=>$message,'selector'=>$selector])
@section($selector->viewName)
@include('incl.menu',['member'=>$member])
<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row" style="padding-top: 16px;">
            <div class="col-md-6 col-xl-3 offset-xl-1"><img class="img-fluid" src="http://sadventure.xf.cz/public/images/avatars/{{$member->avatar}}" /></div>
            <div class="col-xl-6 offset-xl-0 member_page_info">
                <p>Jméno: BLALALALA</p>
            </div>
            <div class="col-xl-9 offset-xl-1">
                <div class="row justify-content-center features">
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box"><a class="learn-more" href="#">Learn more »</a></div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box"><a class="learn-more" href="#">Learn more »</a></div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box"><a class="learn-more" href="#">Learn more »</a></div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box"><a class="learn-more" href="#">Learn more »</a></div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box"><a class="learn-more" href="#">Learn more »</a></div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box"><a class="learn-more" href="#">Learn more »</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@include('incl.menu',['member'=>$member])
@if (!isset($selector->article))
    {{-- $message->add(md5('MemberMiss'),'Pro zobrazení uživatele musí být zadáno jeho jméno')->style('danger');  --}}
@endif

@if(isset($selector->article) && $selector->article !== $member->username) 
    @php  $member->getUserData($selector->article); @endphp
@endif

<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row" style="padding-top: 16px;">
            <div class="col-md-6 col-xl-3 offset-xl-1">
                <img class="img-fluid" src="http://sadventure.xf.cz/public/image/avatars/{{$member->avatar}}" alt="member-avatar" />
            </div>
            <div class="col-xl-6 offset-xl-0 member_page_info">
                <h3 style="color:#ffffff">Informace o vás</h3>
                <p style="color:#ffffff">Uživatel:<a href="/member/{{$member->username}}">{{ $member->username }}<a></p>
                    @if ($member->visible)
                    <p style="color:#ffffff">Jméno: {{$member->memberName}}</p>
                    <p style="color:#ffffff">Příjmení: {{$member->memberSurname}}</p>
                    <p style="color:#ffffff">Datum narození: {{$member->age}}</p>
                    <p style="color:#ffffff">Město: {{$member->location}}</p>
                    @endif
            </div>
            <div class="col-xl-9 offset-xl-1">
                <h2 style="color:#ffffff;margin-top:10vh;">Uložené záložky </h2>
                <p style="color:#73b6ff">* Maximální počet záložek je 12. Uložit záložku lze pouze při čtení příběhu v menu uživatele. 
                <div class="row justify-content-center features" id="bookmarks">
                    @if($member->bookmarkCount == 0)
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box">
                            <a class="learn-more" style="pointer-events: none; cursor: default;"> Nemáte žádnou uloženou záložku </a>
                        </div>
                    </div>
                    @else
                    @foreach ($member->bookmarks as $key => $value)
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box">
                            <a class="learn-more" href="/{{$value}}">Záložka-{{$member->bookmarkCount--}} »</a>
                        <br>
                        <a class="learn-more" href="#">Smazat</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
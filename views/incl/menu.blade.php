<nav class="navbar navbar-light navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#"><img class="img-fluid" src="@asset("image/android-chrome-256x256.png")" style="height: 70px;width: 70px;margin-right: -20px;" alt="brand" width="70" height="70" />tarAdventure</a><button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1" type="button"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div id="navcol-1" class="collapse navbar-collapse text-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active @if($selector->article == 'allwin'){{'active'}}@endif" href="/show/allwin/1">Allwin</a></li>
                <li class="nav-item"><a class="nav-link @if($selector->article == 'samuel'){{'active'}}@endif" href="/show/samuel/1">Samuel</a></li>
                <li class="nav-item dropdown ms-auto" style="margin-top: 2vh;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#" style="margin: auto;margin-top: -2vh;">Isama</a>
                    <div class="dropdown-menu text-center bg-secondary">
                        <a class="dropdown-item @if($selector->article == 'isama'){{'active'}}@endif" href="/show/isama/1">Isama</a>
                        <a class="dropdown-item @if($selector->article == 'isamanh'){{'active'}}@endif" href="/show/isamanh/1">Nový Horizont</a>
                        <a class="dropdown-item @if($selector->article == 'isamanw'){{'active'}}@endif" href="/show/isamanw/1">Nový svět</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="/postavy">Postavy</a></li>
                <li class="dropdown nav-item"><a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false" href="#">Ostatní</a>
                    <div class="dropdown-menu text-center bg-secondary">
                        <a class="dropdown-item active @if($selector->article == 'mry'){{'active'}}@endif" href="/show/mry/1">Mr. Y</a>
                        <a class="dropdown-item  @if($selector->article == 'aeg'){{'active'}}@endif" href="/show/aeg/1">Angel & Eklips</a>
                        <a class="dropdown-item  @if($selector->article == 'hyperion'){{'active'}}@endif" href="/show/hyperion/1">Hyperion</a>
                        <a class="dropdown-item  @if($selector->article == 'star'){{'active'}}@endif" href="/show/star/1">Star</a>
                        <a class="dropdown-item  @if($selector->article == 'demoni'){{'active'}}@endif" href="/show/demoni/1">Demoni</a>
                        <a class="dropdown-item  @if($selector->article == 'terror'){{'active'}}@endif" href="/show/terror/1">Terror</a>
                    </li>
                </div>
            </ul>
        </div>      
        @if($member->logged)
        <div id="menu" class="container d-flex justify-content-center justify-content-xl-end"><img class="rounded-circle" style="width: 70px;height: 70px;margin-right: 1vh;" src="/public/image/avatars/{{$member->avatar}}" />
            <div>
                <div class="dropdown ms-auto" style="margin-top: 2vh;"><a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="#" style="margin: auto;">{{$member->username}} </a>
                    <div class="dropdown-menu text-center bg-secondary" style="margin-left: -5vh;">
                        <a class="dropdown-item" @if($selector->viewName == 'member'){{'active'}}@endif" href="/member/{{$member->username}}">Profil</a>
                        <a class="dropdown-item" href="/updateMember/{{$member->username}}">Upravit Profil</a>
                        @if ($selector->viewName == 'show')
                        <a class="dropdown-item" href="/saveBookmark?article={{$selector->article}}&page={{$selector->page}}">Uložit záložku</a>
                        @endif
                        <a class="dropdown-item" href="/member/{{$member->username}}#bookmarks">Uložené záložky</a>
                        @if ($member->permission == 'admin' || $member->permission == 'rewriter')
                        <a class="dropdown-item" @if($selector->viewName == 'update'){{'active'}}@endif href="/update">Editor</a>
                        <a class="dropdown-item" href="#">Uživatelé</a>   
                        @endif
                        <a class="dropdown-item" href="/logout">Odhlášení</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</nav>
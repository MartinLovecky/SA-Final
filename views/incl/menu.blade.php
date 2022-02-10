<nav class="navbar navbar-light navbar-expand-lg navigation-clean" style="font-family: Aldrich, sans-serif; font-size: 16px;">
    <div class="container"><a class="navbar-brand" href="/index"><img class="img-fluid" src="http://sadventure.xf.cz/public/image/android-chrome-256x256.png" alt="brand" style="width: 60px;height: 60px;"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav text-center mx-auto">
                <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center @if($selector->article == 'allwin'){{'active'}}@endif" href="/show/allwin/1">Allwin</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center @if($selector->article == 'samuel'){{'active'}}@endif" href="/show/samuel/1">Samuel</a></li>
                <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-bs-toggle="dropdown" aria-expanded="false" href="#">Isama</a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'isama'){{'active'}}@endif" role="presentation" href="/show/isama/1">Isama</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'isamanh'){{'active'}}@endif" role="presentation" href="/show/isamanh/1">Nový Horizont</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'isamanw'){{'active'}}@endif" role="presentation" href="/show/isamanw/1">Nový svět</a>
                    </div>
                </li>
                <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center" href="/postavy">Postavy</a></li>
                <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-bs-toggle="dropdown" aria-expanded="false" href="#">Ostatní</a>
                    <div class="dropdown-menu text-center" role="menu">
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'mry'){{'active'}}@endif" role="presentation" href="/show/mry/1">Mr. Y</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'aeg'){{'active'}}@endif" role="presentation" href="/show/aeg/1">Angel & Eklips</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'hyperion'){{'active'}}@endif" role="presentation" href="/show/hyperion/1">Hyperion</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'star'){{'active'}}@endif" role="presentation" href="/show/star/1">Star</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'demoni'){{'active'}}@endif" role="presentation" href="/show/demoni/1">Demoni</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == 'terror'){{'active'}}@endif" role="presentation" href="/show/terror/1">Terror</a>
                    </li>
                </div>
            </ul>  
        @if($member->logged)
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown"><a data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle nav-link" href="#"><img src="http://sadventure.xf.cz/public/image/avatars/{{$member->avatar}}" alt="img" height="60px" style="padding-right: 10px;" />{{$member->username}}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item text-center nav-link @if($selector->viewName == 'member'){{'active'}}@endif" href="/member/{{$member->username}}">Profil</a>
                    <a class="dropdown-item text-center nav-link" href="/updateMember/{{$member->username}}">Upravit Profil</a>
                    @if ($selector->viewName == 'show')
                    <a class="dropdown-item text-center nav-link" href="/saveBookmark?article={{$selector->article}}&page={{$selector->page}}">Uložit záložku</a>
                    @endif
                    <a class="dropdown-item text-center nav-link" href="/member/{{$member->username}}#bookmarks">Uložené záložky</a>
                    @if ($member->permission == 'admin' || $member->permission == 'rewriter')
                    <a class="dropdown-item text-center nav-link" @if($selector->viewName == 'update'){{'active'}}@endif href="/update">Editor</a>
                    <a class="dropdown-item text-center nav-link" href="#">Uživatelé</a>   
                    @endif
                    <a class="dropdown-item text-center nav-link" href="/logout">Odhlášení</a>
                </div>
            </li>
        </ul>
        @endif
    </div>
</nav>
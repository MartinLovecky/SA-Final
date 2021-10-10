<nav class="navbar navbar-light navbar-expand-md navigation-clean" style="font-family: Aldrich, sans-serif;font-size: 16px;">
    <div class="container"><a class="navbar-brand" href="#"><img class="img-fluid" src="@asset('images/android-chrome-256x256.png')" alt="SA" style="width: 60px;height: 60px;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mr-auto text-center">
                <li class="nav-item"><a class="nav-link text-capitalize text-center @if($selector->article == 'allwin'){{'active'}}@endif" href="/show/allwin/1">Allwin</a></li>
                <li class="nav-item"><a class="nav-link text-capitalize text-center @if($selector->article == 'samuel'){{'active'}}@endif" href="/show/samuel/1">Samuel</a></li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-center text-capitalize" aria-expanded="false" data-toggle="dropdown" href="#">Isama </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-center nav-link @if($selector->article == ''){{'active'}}@endif" role="presentation" href="/show/isama/1">Isama</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == ''){{'active'}}@endif" role="presentation" href="/show/isamanh/1">Nový Horizont</a>
                        <a class="dropdown-item text-center nav-link @if($selector->article == ''){{'active'}}@endif" role="presentation" href="/show/isamanw/1">Nový Svět</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">Dropdown </a>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                </li>
            </ul>
        </div>
    </div>
</nav>
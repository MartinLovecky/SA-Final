@extends('incl.app')
@section($selector->viewName)   
<header class="index_header">
    <div class="container-fluid d-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
        <div class="row index_main">
            <div class="col-xl-12 d-flex justify-content-center align-items-center">
                <h1>STAR ADVENTURE</h1>
            </div>
            <div class="col-xl-12 d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                <h2>Dobrodružný / Sci-fi / Fantasy</h2>
            </div>
            <div class="col">
                <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" id="dd_index-container">
                    <a href="#main"><img data-bs-hover-animate="rubberBand" class="dd_index-image" src="http://sadventure.xf.cz/public/image/double-down.png" title="click me"></a>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="main" class="article-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12 index_crossLine">
                <h1 class="text-center">Rozcestník</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-7 offset-xl-0 index_list">
                <h4>Všechny příběhy</h4>
                <ul class="index_list-style">
                    <li><a href="/show/allwin/1">Allwin</a>&nbsp;→&nbsp;Vysvětluje počátek světa, ve kterém se příběh odehrává.<br></li>
                    <li><a href="/show/samuel/1">Samuel</a>&nbsp;→&nbsp;Začátek hlavního příběhu.<br></li>
                    <li><a href="/show/isama/1">Isama</a>&nbsp;→&nbsp;Navazuje na příběh Samuela.<br></li>
                    <li><a href="/show/isamanh/1">Nový Horizont</a>&nbsp;→&nbsp;Pokračování Isamova příběhu.<br></li>
                    <li><a href="/show/isamanw/1">Nový Svět</a>&nbsp;→&nbsp;Závěrečná část Isamova příběhu<br></li>
                    <li><a href="/show/angel/1">Angel &amp; Eklips</a>&nbsp;→&nbsp;Příběh má spojitost s příběhem Allwina.<br></li>
                    <li><a href="/show/mry/1">Mr.Y</a>&nbsp;→&nbsp;Vysvětluje původ Mr.?<br></li>
                    <li><a href="/show/white/1">White Star</a>&nbsp;→&nbsp;Příběh popisuje minulost White Stara.<br></li>
                    <li><a href="/show/terror/1">Lord Terror</a>&nbsp;→&nbsp;Důležitá postava v Novém světě.<br></li>
                    <li><a href="/show/hyperion/1">Hyperion</a>&nbsp;→&nbsp;Historie Nového světa.<br></li>
                    <li><a href="/show/demoni/1">Démoni</a>&nbsp;→&nbsp;Příběh vysvětlující rasu Démonů.<br></li>
                </ul>
                <h4>Vysvětlivky</h4>
                <ul class="index_list-style">
                    <li>"Text"&nbsp;→&nbsp;Jedná se o myšlenky postav.</li>
                    <li>???? →&nbsp;Jedná se o myšlenky postav.</li>
                    <li><span style="color: #34ff67;">Text</span>&nbsp;→&nbsp;Důležitá informace/událost.</li>
                    <li>'Text' → označuje přibližný popis př. Budova vypadala jako 'klášter'.</li>
                </ul>
            </div>
            <div class="col-md-6 col-xl-5 index_list">
                <p style="color: #eef4f7;">Vítám Vás na stránkách StarAdventure,</p>
                <p style="color: #eef4f7;">Pro prohlížení webu je nutné se registrovat a veškerý obsah je chráněn autorským zákonem děkuji za pochopení.</p>
                <p style="color: #eef4f7;">Na webu StarAdventure naleznete příběh odehrávající se v roce 2030, kdy hlavní hrdina&nbsp;<a href="/show/isama/1">Isama</a>&nbsp;zjistí, že žije v mnohem záhadnějším a úžasnějším světě o kterém donedávna neměl tušení že existuje.</p>
                @if (!$member->logged)
                <div class="d-flex d-xl-flex flex-column align-items-xl-end index-log-reg">
                    <a class="btn btn-primary btn-lg d-block btn-default w-100" role="button" href="/login">Přihlášení</a>
                    <a class="btn btn-primary btn-lg d-block btn-default w-100" role="button" href="/register">Registrace</a>
                </div>
                @endif 
            </div>
        </div>
    </div>
</div>
@endsection


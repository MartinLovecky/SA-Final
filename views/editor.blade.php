@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@if ($member->permission === 'admin' || $member->permission === 'editor')
<div class="article-list">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <ol class="breadcrumb" style="margin-top:20px">
                    <li class="breadcrumb-item"><a href="/index">Domů</a></li>
                    <li class="breadcrumb-item"><a href="/member/{{$member->username}}">Profil</a></li>
                    <li class="breadcrumb-item"><a href="/create">Create</a></li>
                    <li class="breadcrumb-item"><a href="/update">Update</a></li>
                    <li class="breadcrumb-item"><a href="/delete">Delete</a></li>
                <ol>
                    @dump($articleController->create($request))
                <ol class="breadcrumb">
                    @if (!$selector->article)
                    <li class="breadcrumb-item"><span class="text-success">Příběh:&nbsp;</span><li>    
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/allwin/1">Allwin</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/samuel/1">Samuel</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/isama/1">Isama</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/isamanw/1">Isama - NW</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/isamanh/1">Isama - NH</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/mry/1">Mr. ?</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/white/1">White</a></li>
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/terror/1">Teror</a></li>
                    @else
                    &nbsp;&nbsp;<span class="text-success"> / Aktivní příběh: <span class="text-danger">{{strtoupper($selector->article)}} | {{$selector->page}}</span></span>
                    @endif
                </ol>
                    {!!$form->options(['target'=>'requestHandler','method'=>'POST','class'=>'text-center'])
                            ->vars(['articlesController'=>$articleController,'request'=>$request])
                            ->run($blade)
                    !!}
                <p class="text-white">*Akce /delete smaže pouze data stránka samotná zůstane</p>
                <label class="text-white">Nadpis:</label><input type="text" name="chapter" @if($article->articleChapter) value="{{$article->articleChapter}}" @endif  placeholder="Může zůstat prázdný">
                <div id="toolbar-container"></div>
                <textarea name="editor1">
                   @if($selector->article && $selector->page)
                        @php $article->getArticle($selector->article,$selector->page); @endphp
                        {!! $article->articleBody !!}
                   @endif
                </textarea>
                <script>
                    CKEDITOR.replace( 'editor1' );
                </script>
                <hr/>
                @isset($selector->article)
                <nav class="d-xl-flex justify-content-xl-center align-items-xl-center" id="wp_pagnation" style="background-color:#272626">
                    <ul class="pagination">
                        {!!  $wrapper->previous_page()   !!}
                        {!!  $wrapper->main_pagnation()  !!}
                        {!!  $wrapper->next_page()  !!}
                    </ul>
                </nav>
                    <input type="hidden" name="type" value="{{$selector->viewName}}">
                    <input type="hidden" name="article"  value="{{$selector->article}}">
                    <input type="hidden" name="page" value="{{$selector->page}}">
                @endisset
                    <button class="btn btn-success btn-block" value="submit" name="submit" type="submit">Odeslat na server</button>
                    <p class="text-white"> * Pro vykonání jakékoliv akce je nutné kliknout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
            </form>
    </div>
</div>
</div>
@else
{{ \header('Location: http://sadventure.com/')}}                          
@endif
@endsection
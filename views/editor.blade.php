@extends('incl.app')
@if ($member->permission === 'admin' || $member->permission === 'editor')
<div class="article-list">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index">Domů</a></li>
                    <li class="breadcrumb-item"><a href="/member/{{$member->username}}">Profil</a></li>
                    <li class="breadcrumb-item"><a href="/create">Create</a></li>
                    <li class="breadcrumb-item"><a href="/update">Update</a></li>
                    <li class="breadcrumb-item"><a href="/delete">Delete</a></li>
                @if (!$selector->article)
                    <li class="breadcrumb-item"><span style="color:#00cc80">Příběh:&nbsp;</span><li>
                
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->viewName)}}//1"></a></li>
                
                @else
                    &nbsp;&nbsp;<span style="color:#00cc80"> / Upravujete příběh {{$selector->article}}</span>
                @endif
                    <p style="color: #fff">*Akce /delete smaže pouze data stránka samotná zůstane</p>
                @if (!$selector->article)
                    {!! $message->message(['error'=>'Pro vykonání akce '.$selector->action.' je nutné zvolit příběh']) !!}
                @endif
                    {!!$form->options(['target'=>'requestHandler','method'=>'POST','class'=>'text-center'])
                            ->vars(['articlesController'=>$articlesController,'request'=>$request])
                            ->run($blade)
                    !!}
                    <label style="color:#fff">Nadpis:</label><input type="text" name="chapter" {{-- comment @isset($articlesController->Article['chapter']) value="{{$articlesController->Article['chapter']}}" @endisset  --}}placeholder="Může zůstat prázdný">
                    <textarea name="content" id="editor">
                        {{-- comment 
                        
                        @isset($articlesController->Article['body'])
                            {!! $articlesController->Article['body'] !!}
                        @endisset
                        --}}
                    </textarea>
                </ol>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
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
                    <button class="btn btn-success btn-block" name="submit" type="submit" value="submit" id="save">Odeslat na server</button>
                    <p style="color:#fff"> * Pro vykonání jakékoliv akce je nutné kliknout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
                @endisset
            </form>
    </div>
</div>
</div>
@else
{{ \header('Location: http://sadventure.com/')}}                          
@endif
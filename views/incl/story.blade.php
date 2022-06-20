@php  $article->getArticle($selector->article,$selector->page);  @endphp
<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row" style="padding-top: 16px;">
            <div class="col-md-6 col-xl-10 offset-xl-1">
                @if (!empty($article->articleChapter)) 
                    <h1 class="text-center">{{$article->articleChapter}}</h1>
                @endif
                    {!! $article->articleBody !!}
            </div>
        </div>
    </div>
</div>
<nav class="d-xl-flex justify-content-xl-center align-items-xl-center" id="wp_pagnation" style="background-color:#272626">
    <ul class="pagination">
        {!!  $wrapper->previous_page()   !!}
        {!!  $wrapper->main_pagnation()  !!}
        {!!  $wrapper->next_page()  !!}
    </ul>
</nav>
{{-- 
    
    1) $selector->article  is set && $selector->page is set;
    2) we neee call fuction $article->getArticle($article,$page);

--}}
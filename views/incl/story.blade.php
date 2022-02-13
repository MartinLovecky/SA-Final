<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row" style="padding-top: 16px;">
            <div class="col-md-6 col-xl-10 offset-xl-1">
                @if (!empty($articlesController->Article['chapter']))
            <h1 class="text-center">{{$articlesController->Article['chapter']}}</h1>@endif
            {!! $articlesController->Article['body']   !!}
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
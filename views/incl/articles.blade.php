<div class="container py-4 py-xl-5">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center text-white mx-auto">
            <h2 class="font-weight-bold">Všechny příběhy</h2>
            <p class="w-lg-50">Curae hendrerit donec commodo hendrerit egestas tempus, turpis facilisis nostra nunc. Vestibulum dui eget ultrices.</p>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
        {{--  static content changable inside app/storyOverview --}}
        {!! $article->overview() !!}
    </div>
</div>
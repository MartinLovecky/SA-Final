@if ($selector->viewName == 'login' || $selector->viewName == 'register')
@else
<footer id="footer">
    <div class="row" id="index_footer">
        <div class="col-sm-6 col-md-4 footer-navigation">
            <h3><a href="/index">Star<span>Adventure</span></a></h3>
            <p class="links"><a href="#">Empty</a><strong> · </strong><a href="/terms">Terms</a><strong> · </strong><a href="/faq">Faq</a><strong> · </strong><a href="/vop">Vop</a></p>
            <p class="company-name">StarAdventure © 2021 ~ Vytvořil&nbsp;<a href="/member/Sensei">Sensei</a></p>
        </div>
        <div class="col-sm-6 col-md-4 footer-contacts">
            <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                <p><span class="new-line-span"></span> Ústí nad Labem, Czech Republic</p>
            </div>
            <div><i class="fa fa-phone footer-contacts-icon"></i>
                <p><a href="https://discord.gg/rGfAZYaa9h">Discord</a></p>
            </div>
            <div><i class="fa fa-envelope footer-contacts-icon"></i>
                <p><a href="/kontakt" target="_blank">staradvanture.suport@seznam.cz</a></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4 footer-about">
            <div class="social-links social-icons"><a href="https://www.facebook.com/marthas.lovecky"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/LoveckyMartin"><i class="fa fa-twitter"></i></a><a href="https://github.com/MartinLovecky/"><i class="fa fa-github"></i></a></div>
        </div>
    </div>
</footer>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
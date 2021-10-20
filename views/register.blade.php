@if (!$member->logged)
<section class="login-dark">
	{{-- you can set / add  a lot more options see inside \Sa\tool\html\Forms --}}
    {!! $form->options(['target'=>'requestHandler'])
			 ->values(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
        <h2 class="sr-only">Registrace</h2>
        <div class="illustration"><i class="icon ion-ios-locked"></i></div>
	    <div class="form-group"><input type="text" name="username" value="@isset($_SESSION['old_username']){{$_SESSION['old_username']}}@endisset" placeholder="Uživatel" class="form-control" required/></div>
	    <div class="form-group"><input type="email" name="email" value="@isset($_SESSION['old_email']){{$_SESSION['old_email']}}@endisset" placeholder="Email" class="form-control" required/></div>
	    <div class="form-group"><input type="password" name="password" placeholder="Heslo" class="form-control" required/></div>
	    <div class="form-group"><input type="password" placeholder="Heslo (znovu)" name="password_again" class="form-control" required/></div>
	    <div class="form-check text-left"><input type="checkbox" name="persistent_register" value="yes" class="form-check-input" id="formCheck-1" required/><label class="form-check-label text-left" for="formCheck-1">Souhlasím :<a href="/terms" class="forgot">Smluvní podmínky</a><a href="/vop" class="forgot">Ochrana soukromí</a></label></div><br/>
	    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Register</button></div>
        <a href="/login" class="forgot">Máte již účet?</a>
        <hr/>
	<div class="g-recaptcha" id='recaptcha' data-sitekey="6LdKkYEUAAAAAE5Ykg8LY5gOPNXzgTyIG3FVuCqM" data-badge="inline" data-size="invisible" data-callback="onSubmit"></div>
	@csrf
	<input type="hidden" name="type" value='register'>
    </form>
	<script>onload();</script>
</section>

@else
{{ \header('Location: http://sadventure.com/member/'.$member->username.'')}}
@endif

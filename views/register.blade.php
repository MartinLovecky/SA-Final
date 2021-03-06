@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@if (!$member->logged)

<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler','class'=>'text-left'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
        <h2 class="sr-only">Registrace</h2>
        <div class="illustration"><i class="icon ion-ios-locked"></i></div>
	    <div class="form-group mb-3"><input type="text" name="username" value="@isset($_SESSION['old_username']){{$_SESSION['old_username']}}@endisset" placeholder="Uživatel" class="form-control" required/></div>
	    <div class="form-group mb-3"><input type="email" name="email" value="@isset($_SESSION['old_email']){{$_SESSION['old_email']}}@endisset" placeholder="Email" class="form-control" required/></div>
	    <div class="form-group mb-3"><input type="password" name="password" placeholder="Heslo" class="form-control" required/></div>
	    <div class="form-group mb-3"><input type="password" placeholder="Heslo (znovu)" name="password_again" class="form-control" required/></div>
	    <div class="form-check"><input type="checkbox" name="persistent_register" value="yes" class="form-check-input" id="formCheck-1" required/><label class="form-check-label" for="formCheck-1">Souhlasím:</label></div>
		<a href="/terms" class="forgot">Smluvní podmínky</a>
		<a href="/vop" class="forgot">Ochrana soukromí</a>
	    <button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Register</button>
        <hr/>
		<a href="/login" class="forgot">Máte již účet?</a>
		@csrf
		<input type="hidden" name="type" value='register'>
		<input type="hidden" id="g-recaptcha-response" name="grecaptcharesponse">
    	<input type="hidden" name="action" value="validate_captcha">
    </form>
	<script src="https://www.google.com/recaptcha/api.js?render=6LeSEOAgAAAAAFoksW-Nm51i4qwmA3zdX0iBeJP1"></script>
	<script>
		grecaptcha.ready(function() {
		// do request for recaptcha token
		// response is promise with passed token
			grecaptcha.execute('6LeSEOAgAAAAAFoksW-Nm51i4qwmA3zdX0iBeJP1', {action:'validate_captcha'})
					  .then(function(token) {
				// add token value to form
				document.getElementById('g-recaptcha-response').value = token;
			});
		});
	</script>
</section>
@else
{{ \header('Location: /member/'.$member->username.'')}}
@endif

@endsection
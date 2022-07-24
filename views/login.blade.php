@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@if (!$member->logged)

<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
    <h2 class="sr-only">Login</h2>
    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
    <div class="form-group mb-3"><input type="text" name="username" placeholder="Uživatel" class="form-control" value="@isset($_SESSION['old_username']){{$_SESSION['old_username']}}@endisset" required/></div>
    <div class="form-group mb-3"><input type="password" name="password" class="form-control" placeholder="Heslo" required/></div>
    <div class="form-group"><input type="checkbox" name="remeber" value="yes"><label class="form-check-label">&nbsp; Zůstat přihlášen</label></div>
    <button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Přihlášení</button>
    <hr/>
    <a href="/register" class="forgot">Nemáte účet ?</a>
    <a href="/reset" class="forgot">Zapomenuté heslo ?</a>
    @csrf
    <input type="hidden" name="type" value='login'>
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
	{{ header('Location: /member/'.$member->username.'') }}
@endif
@endsection


@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
@if (!$member->logged)
<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
    <h2 class="sr-only">Ověření emailu</h2>
    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
    <div class="form-group mb-3"><input type="email" name="email" placeholder="Email" class="form-control" required/></div>
    <button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Poslat znovu</button>
    <hr/>
    <a href="/register" class="forgot">Nemáte účet ?</a>
    <a href="/reset" class="forgot">Zapomenuté heslo ?</a>
    @csrf
    <input type="hidden" name="type" value='register'>
	<input type="hidden" id="g-recaptcha-response" name="grecaptcharesponse">
    <input type="hidden" name="type" value='verifyUser'>  
</form>
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
@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler','class'=>'text-left'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
        <h2 class="text-center">OBNOVENÍ HESLA</h2>
		<input type="hidden" id="g-recaptcha-response" name="grecaptcharesponse">
    	<input type="hidden" name="action" value="validate_captcha">
	    <div class="form-group mb-3"><input type="email" name="email" value="@isset($_SESSION['old_email']){{$_SESSION['old_email']}}@endisset" placeholder="Zadejte email" class="form-control text-center" required/></div>
        <div class="form-group mb-3"><button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Obnovit</button></div>
        <hr/>
        <a href="/index" class="forgot">Úvodí stránka</a>
        &nbsp;
		@csrf
		<input type="hidden" name="type" value='reset_send'>
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
@endsection
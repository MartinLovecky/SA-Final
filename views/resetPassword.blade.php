@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler','class'=>'text-left'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
        <h2 class="text-center">Nové heslo</h2>
		<input type="hidden" id="g-recaptcha-response" name="grecaptcharesponse">
    	<input type="hidden" name="action" value="validate_captcha">
	    <div class="form-group mb-3"><input type="password" name="password" placeholder="Heslo" class="form-control" required/></div>
	    <div class="form-group mb-3"><input type="password" placeholder="Heslo (znovu)" name="password_again" class="form-control" required/></div>
        <div class="form-group mb-3"><button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Změnit heslo</button></div>
        <hr/>
        <a href="/login" class="forgot">Máte již účet?</a>
        &nbsp;
		@csrf
		<input type="hidden" name="type" value='reset_pwd'>
        <input type="hidden" name="hash" value='@isset($selector->fristQueryValue){{$selector->fristQueryValue}}@endisset'>
        <input type="hidden" name="id" value='@isset($selector->secondQueryValue){{$selector->secondQueryValue}}@endisset'>
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
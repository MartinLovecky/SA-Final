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
		<a href="/vop" class="forgot">Ochrana soukromí</a><br>
	    <div class="form-group mb-3"><button class="btn btn-success btn-lg d-block w-100" name="submit" type="submit" value="submit">Register</button></div>
        <a href="/login" class="forgot">Máte již účet?</a>
        <hr/>
		<div class="g-recaptcha" id='recaptcha' data-sitekey="6LdKkYEUAAAAAE5Ykg8LY5gOPNXzgTyIG3FVuCqM" data-badge="inline" data-size="invisible" data-callback="onSubmit"></div>
		@csrf
		<input type="hidden" name="type" value='register'>
    </form>
	<script>onload();</script>
</section>

@else
{{ \header('Location: /member/'.$member->username.'')}}
@endif

@endsection
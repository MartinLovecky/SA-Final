@extends('incl.app',['selector'=>$selector,'message'=>$message])
@section($selector->viewName)
<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler','class'=>'text-left'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
        <h2 class="text-center">OBNOVENÍ HESLA</h2>
	    <div class="form-group mb-3"><input type="email" name="email" value="@isset($_SESSION['old_email']){{$_SESSION['old_email']}}@endisset" placeholder="Zadejte email" class="form-control text-center" required/></div>
        <div class="form-group mb-3"><button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Obnovit</button></div>
        <hr/>
        <a href="/index" class="forgot">Úvodí stránka</a>
        &nbsp;
		<div class="g-recaptcha" id='recaptcha' data-sitekey="6LdKkYEUAAAAAE5Ykg8LY5gOPNXzgTyIG3FVuCqM" data-badge="inline" data-size="invisible" data-callback="onSubmit"></div>
		@csrf
		<input type="hidden" name="type" value='reset_send'>
    </form>
	<script>onload();</script>
</section>
@endsection
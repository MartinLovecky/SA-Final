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
    <div class="form-group mb-3"><button class="btn btn-primary btn-lg d-block w-100" name="submit" type="submit" value="submit">Přihlášení</button></div>
    <hr/>
    <a href="/register" class="forgot">Nemáte účet ?</a>
    <a href="/reset" class="forgot">Zapomenuté heslo ?</a>
    &nbsp;
    <div class="g-recaptcha" id='recaptcha' data-sitekey="6LdKkYEUAAAAAE5Ykg8LY5gOPNXzgTyIG3FVuCqM" data-badge="inline" data-size="invisible" data-callback="onSubmit"></div>
    @csrf
    <input type="hidden" name="type" value='login'>  
</form>
<script>onload();</script>
</section>
@else 
	{{ header('Location: /member/'.$member->username.'') }}
@endif
@endsection


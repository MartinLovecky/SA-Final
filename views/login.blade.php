@extends('incl.app',['message'=>$message,'selector'=>$selector])
@section($selector->viewName)
@if (!$member->logged)
<section class="login-dark">
    {!! 
		$form->options(['target'=>'requestHandler'])
			 ->vars(['requestController'=>$requestController,'request'=>$request])
			 ->run($blade) 
	!!}
    <h2 class="sr-only">Login</h2>
    <div class="illustration"><i class="icon ion-ios-unlocked"></i></div>
    <div class="form-group"><input type="text" name="username" placeholder="Uživatel" class="form-control" value="@isset($_SESSION['old_username']){{$_SESSION['old_username']}}@endisset" required/></div>
    <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Heslo" required/></div>
    <div class="form-group text-left"><input type="checkbox" name="remeber" value="yes"><label class="form-check-label">&nbsp Zůstat přihlášen</label></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Přihlášení</button></div>
    <a href="/register" class="forgot">Nemáte účet ?</a><a href="/reset" class="forgot">Zapomenuté heslo ?</a>
    @csrf
    <input type="hidden" name="type" value='login'>  
</form>
</section>

@else 
	{{ header('Location: /member/'.$member->username.'') }}
@endif
@endsection
@dump($selector->fristQueryValue)

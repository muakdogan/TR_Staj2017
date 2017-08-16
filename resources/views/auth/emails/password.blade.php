<?php
	if ($user->password == "")
	{
		echo "Şifrenizi belirlemek için tıklayın: ";
		$belirleme = 1;
	}
	
	else
	{
		echo "Şifrenizi sıfırlamak için tıklayın: ";
		$belirleme = 0;
	}
?>

token: {{$token}}<br>

<a href="{{ $link = url('password/reset', [$belirleme, $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

<?php
	if ($user->password == NULL)
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

<a href="{{ $link = url('password/reset', [$belirleme, $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Welcome to my site</h2>

        <div>
Please activate your account: copy and past bellow code on the link
        </div>
		<a href="http://laravel.local/activation/<?php echo $id?>"> Click here to go the activation page</a>
        <div>Activation code: <b>{{ $activation_code }}</b></div>
    </body>
</html>


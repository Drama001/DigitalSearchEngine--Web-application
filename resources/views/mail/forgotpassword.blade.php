Hello {{$email_info['name']}}
<br><br>
<b>Welcome to Digital library!</b>
<br>
Please click the below link to change your password
<br><br>
<a href="{{ url('setnewpassword/'.$email_info['email']) }}">click here</a>

<br><br>
Thank you

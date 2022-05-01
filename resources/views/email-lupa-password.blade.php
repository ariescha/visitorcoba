@component('mail::message')
<h1>Reset Password JMDC Visitor</h1>

<p style="text-center">Password Anda telah di reset, silahkan melakukan pembaharuan password.
Silahkan klik tombol di bawah ini</p>
@component('mail::button',['url'=>route('reset-password-form',$token)])
Reset Password
@endcomponent

@endcomponent

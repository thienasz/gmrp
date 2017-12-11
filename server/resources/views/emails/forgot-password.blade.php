<h1>Hello</h1>

<p>
    Please click the following link to activate your account,

    <a href="{{env('APP_URL')}}/ntdesign/public/api/forgot-password/{{$code}}">Click here!</a>
</p>

Or click the link below:
<p>
    <a href="{{env('APP_URL')}}/ntdesign/public/api/forgot-password/{{$code}}">
        {{env('APP_URL')}}/ntdesign/public/api/forgot-password/{{$code}}
    </a>
</p>
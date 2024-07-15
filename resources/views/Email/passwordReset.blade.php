@component('mail::message')

    <h3>{{ $details['title'] }}</h3>
    <h3>{{ $details['body'] }}</h3>

    @component('mail::button', ['url' => url('/response-password-reset?token='.$token)])
        استرجاع
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent


@component('mail::message')
    Bonjour
    Vous avez un nouveau message de: <strong>{{ $details['name'] }}</strong> <br>
    <strong>Nom et Prenom:</strong> {{ $details['name'] }} <br>
    @if (!empty($details['email']))
        <strong>Email:</strong> {{ $details['email'] }} <br>
    @endif
    @if (!empty($details['tele']))
        <strong>Télephone:</strong> {{ $details['tele'] }} <br>
    @endif
    @if (!empty($details['message']))
           <strong>Message:</strong> {{ $details['message'] }}<br><br>
    @endif
 
    Cordialement,
@endcomponent


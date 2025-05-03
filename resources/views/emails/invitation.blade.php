<!DOCTYPE html>
<html>
<head>
    <title>Invitation to {{ $event->name }}</title>
</head>
<body>
    <h1>You're Invited!</h1>
    
    <p>Dear {{ $guest->name }},</p>
    
    <p>You have been invited to {{ $event->name }}.</p>
    
    <h2>Event Details:</h2>
    <ul>
        <li>Date: {{ $event->date }}</li>
        <li>Location: {{ $event->location }}</li>
    </ul>
    
    <p>Please click the link below to RSVP:</p>
    <a href="{{ route('guests.rsvp', ['guest' => $guest->id]) }}">RSVP Now</a>
    
    <p>If you have any dietary preferences or special requests, please let us know when you RSVP.</p>
    
    <p>Best regards,<br>
    The Event Organizer</p>
</body>
</html> 
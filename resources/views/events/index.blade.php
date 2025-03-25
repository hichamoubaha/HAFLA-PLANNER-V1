<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
</head>
<body>
    <h2>Liste des événements</h2>
    <a href="{{ route('events.create') }}">Créer un événement</a>

    @foreach($events as $event)
        <div>
            <h3>{{ $event->title }}</h3>
            <p>{{ $event->description }}</p>
            <p>Date : {{ $event->date }} | Heure : {{ $event->time }}</p>
            <p>Lieu : {{ $event->location }}</p>
            @if(Auth::id() === $event->user_id)
                <a href="{{ route('events.edit', $event) }}">Modifier</a>
                <form action="{{ route('events.destroy', $event) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            @endif
        </div>
    @endforeach
</body>
</html>

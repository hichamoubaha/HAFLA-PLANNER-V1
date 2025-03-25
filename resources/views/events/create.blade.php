<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
</head>
<body>
    <h2>Créer un nouvel événement</h2>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Titre" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="date" name="date" required>
        <input type="time" name="time" required>
        <input type="text" name="location" placeholder="Lieu" required>
        <button type="submit">Créer</button>
    </form>
</body>
</html>

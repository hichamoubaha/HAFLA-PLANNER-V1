<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h2>Bienvenue, {{ Auth::user()->name }}</h2>
    <p>Rôle : {{ Auth::user()->role }}</p>

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.users') }}">Gérer les utilisateurs</a>
    @endif

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>

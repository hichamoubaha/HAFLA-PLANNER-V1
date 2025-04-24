<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un événement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            font-size: 28px;
            margin: 40px 0;
        }
        
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        input, textarea {
            width: 100%;
            padding: 15px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        input::placeholder, textarea::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>
    <h2>Modifier l'événement</h2>
    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" placeholder="Titre" value="{{ $event->title }}" required>
        <textarea name="description" placeholder="Description" required>{{ $event->description }}</textarea>
        <input type="date" name="date" value="{{ $event->date }}" required>
        <input type="time" name="time" value="{{ $event->time }}" required>
        <input type="text" name="location" placeholder="Lieu" value="{{ $event->location }}" required>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html> 
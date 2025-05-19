<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Nouvelle demande de congé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007BFF;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin: 10px 0;
        }

        .content strong {
            color: #007BFF;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Nouvelle demande de congé</h1>
        </div>

        <div class="content">
            <p>Bonjour,</p>
            <p>Une nouvelle demande de congé a été créée par <strong>{{ $user->name }}</strong>.</p>
            <p><strong>Type de congé :</strong> {{ ucfirst($conge->type) }}</p>
            @if ($conge->dure == 'one_journe')
                <p><strong>Date :</strong> {{ $conge->date_jour }}</p>
            @elseif ($conge->dure == 'many_journees')
                <p><strong>Date de début :</strong> {{ $conge->date_debut }}</p>
                <p><strong>Date de fin :</strong> {{ $conge->date_fin }}</p>
            @elseif ($conge->dure == 'heures')
                <p><strong>Date :</strong> {{ $conge->date_jour }}</p>
                <p><strong>Nombre d'heures :</strong> {{ $conge->nb_heures }}</p>
            @endif
            <p>Merci de bien vouloir vérifier cette demande dans l'interface d'administration.</p>
        </div>

        <div class="footer">
            <p>SIM</p>
        </div>
    </div>
</body>

</html>

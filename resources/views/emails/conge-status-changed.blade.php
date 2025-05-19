<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Changement de statut de votre congé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .header {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }

        .content {
            margin: 20px 0;
        }

        .status {
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }

        .status.accepte {
            background-color: #28a745;
            color: white;
        }

        .status.refuse {
            background-color: #dc3545;
            color: white;
        }

        .status.annuler {
            background-color: #ffc107;
            color: white;
        }

        .footer {
            text-align: center;
            color: #777;
            margin-top: 30px;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Notification de Congé</h2>
        </div>

        <div class="content">
            <p>Bonjour {{ $user->name }},</p>

            <p>Nous souhaitons vous informer que votre demande de congé a été mise à jour. Vous trouverez ci-dessous les
                détails :</p>

            {{-- Status --}}
            <div class="status {{ strtolower($status) }}">
                @if ($status == 'accepte')
                    <p>Bonne nouvelle ! Votre congé a été <strong>accepté</strong>.</p>
                @elseif ($status == 'refuse')
                    <p>Nous sommes désolés de vous informer que votre demande de congé a été <strong>refusée</strong>.
                    </p>
                @elseif ($status == 'annuler')
                    <p>Votre demande de congé a été <strong>annulée</strong>.</p>
                @endif
            </div>

            {{-- Leave Type and Details --}}
            @if ($conge->type == 'autorisation')
                <p>Type de congé : <strong>Autorisation spéciale</strong></p>
                <p>Date : {{ $conge->date_jour }}</p>
                <p>Durée : {{ $conge->nb_heures }} heures</p>
            @elseif ($conge->type == 'one_journee')
                <p>Type de congé : <strong>Congé d'une journée</strong></p>
                <p>Date : {{ $conge->date_jour }}</p>
            @elseif ($conge->type == 'many_journees')
                <p>Type de congé : <strong>Congé de plusieurs journées</strong></p>
                <p>Date de début : {{ $conge->date_debut }}</p>
                <p>Date de fin : {{ $conge->date_fin }}</p>
            @elseif ($conge->type == 'heures')
                <p>Type de congé : <strong>Congé en heures</strong></p>
                <p>Date : {{ $conge->date_jour }}</p>
                <p>Durée : {{ $conge->nb_heures }} heures</p>
            @endif

            <p>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>
        </div>

        <div class="footer">
            <p>Merci,</p>
            <p>L'équipe RH</p>
        </div>
    </div>
</body>


</html>

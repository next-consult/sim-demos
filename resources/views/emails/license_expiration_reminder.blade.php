<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rappel d'expiration de licence</title>
</head>
<body>
    <h1>Rappel d'expiration de licence</h1>
    <p>Bonjour,</p>
    <p>Nous vous informons que la licence pour le produit <strong>{{ $nom }}</strong> expirera le <strong>{{ \Carbon\Carbon::parse($dateExpiration)->format('d/m/Y') }}</strong>.</p>
    <p>Veuillez prendre les mesures nécessaires pour renouveler la licence avant la date d'expiration.</p>
    <p>Merci,</p>
    <p>L'équipe de gestion des stocks</p>
</body>
</html>
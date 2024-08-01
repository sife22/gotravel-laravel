<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle réservation</title>
</head>
<body>
    @if($client)
    <h1>Une nouvelle réservation pour votre agence.</h1>
    <h2>Nom de client : {{ $client->nom }} {{ $client->prenom }}</h2>
    <h2>Tél de client : {{ $client->tel }}</h2>
    <h2>Titre voyage : {{ $voyage->titre }}</h2>
    <a href="https://www.gotravel.ma">Visitez-nous</a>
    @elseif($agence)
    <h1>Une nouvelle réservation BTOB pour votre agence.</h1>
    <h2>Nom d'agence : {{ $agence->raison_sociale }}</h2>
    <h2>Tél d'agnece : {{ $agence->tel }}</h2>
    <h2>Titre voyage : {{ $voyage->titre }}</h2>
    <a href="https://www.gotravel.ma">Visitez-nous</a>
    @endif
</body>
</html>
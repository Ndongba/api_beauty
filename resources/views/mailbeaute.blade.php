<!DOCTYPE html>
<html>
<head>
    <title>Mail Beauté</title>
</head>
<body>
    <h1>Bonjour, {{ $user->name }}</h1>
    <p>Votre rendez-vous est prévu le {{ $reservation->date_prévue }} à {{ $reservation->heure_prévue }}
        chez {{ $reservation->professionnel->name }} :</p> <!-- Assurez-vous que la relation 'professionnel' est définie -->
    <p>Merci d'avoir utilisé notre service de réservation et à bientôt !</p>
    <ul>
        <li>Email : {{ $user->email }}</li>
        <li>Détails supplémentaires : {{ $mailData['details'] }}</li>
    </ul>
</body>
</html>

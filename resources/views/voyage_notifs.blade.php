<body>
    <h2>Un nouveau voyage pour vous, vous pouvez le découvrir..</h2>
    <h2>{{ $new_voyage->titre }}</h2>
    <p>{{ $new_voyage->pays }}</p>
    <p>{{ $new_voyage->ville }}</p>
    <a href="https://www.gotravel.ma/voyages/{{ $new_voyage->id }}">Voir plus</a>
    <br>
    <a href="https://www.gotravel.ma">Visitez-nous</a>
</body>

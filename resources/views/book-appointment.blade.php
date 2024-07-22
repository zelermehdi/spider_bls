<!DOCTYPE html>
<html>
<head>
    <title>Automatisation de Rendez-vous BLS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Automatisation de Rendez-vous BLS</h2>
        <form action="/book-appointment" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Réserver Rendez-vous</button>
        </form>
    </div>
</body>
</html>
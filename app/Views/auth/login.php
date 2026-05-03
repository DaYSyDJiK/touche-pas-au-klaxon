<h1 class="mb-4">Connexion</h1>

<form method="POST" action="/touche-pas-au-klaxon/public/index.php/auth/authenticate">

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>



</form>
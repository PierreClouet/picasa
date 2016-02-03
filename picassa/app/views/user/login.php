<div class="container">
    <div class="login">
        <form method='post' action="<?php echo DIR;?>utilisateur/login">
            <input type='text' name="login" placeholder="Login..." required /><br />
            <input type='password' name="password" placeholder="Mot de passe..." required /><br />
            <label for="test">Rester connecté</label><input id="test" type='checkbox' name="remember"/><br />
            <input type="submit" value="Valider" />
        </form>
    </div>
</div>
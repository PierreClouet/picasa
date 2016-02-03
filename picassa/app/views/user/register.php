<div class="container">
    <div class="register">
        <form method='post' action="<?php echo DIR;?>utilisateur/inscription">
           <input type='text' name="login" placeholder="Login..." required /><br />
            <input type='email' name="email" placeholder="Email..." required /><br />
            <input type='password' name="password" placeholder="Mot de passe..." required /><br />
            <input type='password' name="password-again" placeholder="Confirmez le mot de passe..." required /><br />
            <input type="submit" value="Je m'inscris" />
        </form>
    </div>
</div>
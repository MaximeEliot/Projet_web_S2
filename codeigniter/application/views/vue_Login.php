            <h1>Connexion</h1>
            <form method="post"> 
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required>
                
                <label for="passwd">Password :</label>
                <input type="password" id="passwd" name="passwd" required>
                
                <input type="submit" name="Connect" value="Connexion">
            </form>
            <p>Pas de compte ? <a href="<?=site_url('users/create_user')?>">Inscrivez-vous</a></p>
        </article>
    </main>
</body>
</html>
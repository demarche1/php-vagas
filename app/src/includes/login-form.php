<section class="bg-light mt-3">
    <div class="row p-5 text-dark">
        <div class="col">
            <form method="POST">
                <h2 class="text-center">Entrar</h2>
                <?php echo isset($_GET['loginError']) ? '<div class="mt-3 alert alert-warning">' . $_GET['loginError'] . '</div>' : ''; ?>
                <?php echo isset($_GET['loginSuccess']) ? '<div class="mt-3 alert alert-success">' . $_GET['loginSuccess'] . '</div>' : ''; ?>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" name="email" type="email" placeholder="exemplo@email.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control" name="password" type="password" required>
                </div>
                <div class="form-group pt-2">
                    <button class="form-control btn btn-primary" name="send" value="login">Entrar</button>
                </div>
            </form>
        </div>
        <div class="col">
            <form method="POST">
                <h2 class="text-center">Registrar-se</h2>
                <?php echo isset($_GET['registerError']) ? '<div class="mt-3 alert alert-warning">' . $_GET['registerError'] . '</div>' : ''; ?>
                <?php echo isset($_GET['registerSuccess']) ? '<div class="mt-3 alert alert-success">' . $_GET['registerSuccess'] . '</div>' : ''; ?>
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" name="name" type="text" placeholder="Digite seu nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" name="email" type="email" placeholder="exemplo@email.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control" name="password" type="password" required>
                </div>
                <div class="form-group pt-2">
                    <button class="form-control btn btn-primary" name="send" value="register">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</section>
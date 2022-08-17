
<?php

require_once 'templates/header.php';

?>


<div class="container-fluid" id='main-container'>
    <div class="col-md-12">
        <div class="row" id='auth-row'>
            <div class="col-md-4" id='login-container'>
                <h2>Entrar</h2>

            <form action="auth_process.php" method='POST'>
            <input type="hidden" name='type' value='login'>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name='email' placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name='password' placeholder="Senha">
                </div>
                <button type="submit" class="btn card-btn">Entrar</button>
            </form>
            </div>

            

            <div class="col-md4" id='register-container'>
                <h2>Criar conta</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method='POST'>
                    <input type="hidden" name='type' value='register'>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name='email' placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name='name' placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="lastname">Sobrenome</label>
                    <input type="text" class="form-control" id="lastname" name='lastname' placeholder="Sobrenome">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" id="password" name='password' placeholder="Senha">
                </div>

                <div class="form-group">
                    <label for="confirmpassword">Digite a senha novamente</label>
                    <input type="password" class="form-control" id="confirmpassword" name='confirmpassword' placeholder="Senha">
                </div>
                <button type="submit" class="btn card-btn">Criar conta</button>
            </form>

        </div>
    </div>
    </div>

</div>


<?php

require_once 'templates/footer.php';

?>


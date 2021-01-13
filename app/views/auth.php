<!doctype html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<? include_once "layout/head.php"?>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?=BASE_URL?>">Тестовое задание</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?=BASE_URL?>/auth">Войти</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">


        <main class="col-md-4 offset-md-4 mb-4">
            <div class="panel-body" >
                <h2 style="text-align: center;">Авторизация</h2>
                <hr>
                <?php if($error['error']){
                    echo'
                     <div class="alert alert-danger" role="alert">
                        <strong>'.$error['error'].'</strong>
                </div>
                    ';
                }?>
            <form name="form" id="form" class="form-horizontal" method="POST">

                <div class="input-group">
                    <input id="user" type="text" class="form-control" name="login" value="<?=$post['login']?>" placeholder="Логин">
                </div>

                <div class="input-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Пароль">
                </div>

                <div class="form-group">
                    <!-- Button -->
                    <div class="col-sm-12 controls" style="text-align: center;">
                        <button style="width: 120px" type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Вход</button>
                    </div>
                </div>

            </form>
            </div>

        </main>
    </div>
</div>
<? include_once "layout/footer.php"?>
</body>
</html>

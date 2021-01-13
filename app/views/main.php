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
            <?php if(!$admin){
                echo '<a class="nav-link" href="'.BASE_URL.'/auth">Войти</a>';
            } else{
                echo '<a class="nav-link" href="'.BASE_URL.'/logout">Выход</a>';
            }
            ?>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">


        <main class="col-md-12">
            <div class="add_tasc_link">
                <a href="<?=BASE_URL?>/add">Добавить задачу</a>
            </div>
            <hr>
            <h2>Задачи</h2>
            <?php if($message){
                echo '
                <div class="alert alert-success" role="alert">
                        <strong>'.$message.'</strong>
                </div>
                ';
            }?>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                      <?=$sort_link?>
                    </tr>
                    </thead>
                    <tbody>
                    <?=$table?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?=$pagination?>
            </nav>

        </main>
    </div>
</div>
<? include_once "layout/footer.php"?>
</body>
</html>

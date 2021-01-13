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
                <h2>Добавление задачи</h2>
            </div>
            <hr>

            <div class="col-md-5 offset-md-4 mb-4">

                <form method="post" action="">

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Имя</label>
                            <input type="text" name="name" class="form-control" value="<?=$post['name']?>" required="">
                            <small class="error"><?=$error['name']?></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="<?=$post['email']?>" required="">
                            <small class="error"><?=$error['email']?></small>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <label class="form-label">Текст задания</label>
                            <p class="error"></p>
                            <textarea rows="5" name="text" class="form-control" cols="45" required=""><?=$post['text']?></textarea>
                            <small class="error"><?=$error['text']?></small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="btn btn-primary btn-lg btn-block" name="submite" type="submit">Добавить</button>
                </form>
            </div>

        </main>
    </div>
</div>
<? include_once "layout/footer.php"?>
</body>
</html>

<?php

class TaskController{

    public function __construct()
    {
        $this->ToTask = new ToTask();
    }


    /**
     * Главный Action
     * @return bool
     */
    public function ActionIndex(){

        $admin = $_SESSION['admin'];

        /**
         * Сохранение новой задачи
         */
        if ($_POST){

            $_POST = Functions::check_security($_POST);

            $error = $this->Validator($_POST);


            if(empty($error)){

                $this->ToTask->AddTask($_POST['name'],$_POST['email'],$_POST['text']);

                $_SESSION['success'] = 'Задача успешно добавлена.';

                header('Location:   '.BASE_URL);

                exit();

            }

        }

        $post = $_POST;

        include_once __DIR__."/../views/task.php";
        return true;

    }



    /**
     * Редактирование задачи админом
     * @param null $id
     * @return bool
     */
    public function ActionEdit($id = null){

        if(!$_SESSION['admin'] || !intval($id)){
            header('Location: '.BASE_URL.'/auth');
            exit();
        }
        if(!intval($id)){
            header('Location: '.BASE_URL);
            exit();
        }

        $admin = $_SESSION['admin'];

        if($_POST){

            $_POST = Functions::check_security($_POST);

            $error = $this->Validator($_POST);

            if(empty($error)){

                $task = $this->ToTask->GetTask($id);

                similar_text($task['text'], $_POST['text'], $perc);

                $edit = 0;
                if($perc != 100){
                    $edit = 1;
                }

                $this->ToTask->EditTask($id,$_POST['name'],$_POST['email'],$_POST['text'],$_POST['status'],$edit);

                $success = true;
            }

        }

        $task = $this->ToTask->GetTask($id);
        $post = $task;

        include_once __DIR__."/../views/edit_task.php";
        return true;

    }



    /**
     * Валидатор
     * @param null $post
     * @return bool
     */

    private function Validator ($post = null){

        $error =[];

        if ( filter_var($post['email'], FILTER_VALIDATE_EMAIL) === false) {
            $error['email'] = "Формат Email неправильный";
        }

        if ( mb_strlen($post['name'], 'utf-8') < 2) {
            $error['name'] = "Минимум 2 символа";
        }

        if ( mb_strlen($post['text'], 'utf-8') < 10) {
            $error['text'] = "Минимум 10 символов";
        }

        return $error;
    }
}
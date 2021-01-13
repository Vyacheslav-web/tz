<?php

class MainController{


    public function __construct()
    {
        $this->ToTask = new ToTask();
    }


    public function ActionIndex($data = null){

        $admin = $_SESSION['admin'];

        /**
         * Общие переменные
         */

        $page = 1;
        $sort = 'id';
        $by = 'DESC';

        $link_array = [
            'name'      => 'Имя пользователя',
            'email'     => 'Email',
            'text'      => 'Текст задачи',
            'status'    => 'Статус'
            ];

        $pagination_conf = [
            'limit' => 3,
            'show'  => 1,
            'prev_show' => 0,
            'next_show' => 0,
            'first_show' => 0,
            'last_show' => 0,
            'prev_text' => 'назад',
            'next_text' => 'вперед',
            'class_active' => 'active',
            'separator' => ' ... ',
        ];

        /**
         * Обработка GET, так же прогоняем через защиту
         */

        if($data){

            $urlQuery = Functions::UrlParse($data);

            if($urlQuery['page']){
                $page = (int)$urlQuery['page'];
            }

            if($urlQuery['sort']){
                $sort = $urlQuery['sort'];
            }

            if($urlQuery['by'] === 'asc'){
                $by = 'ASC';
            }

        }



        /**
         * Сортировка
         */

        $sort_link = null;
        foreach ($link_array as $k => $link){

            $sort_link.=' <th><a href="'.BASE_URL.Functions::sort($data,$k,$by == 'ASC'?'desc':'asc').'">'.$link.'</a></th>';

        }



        /**
         * Пагинация
         */

        $tasks_count = $this->ToTask->CountTask();
        $offset = ($page - 1) * $pagination_conf['limit'];
        $page_count = ceil($tasks_count / $pagination_conf['limit']);
        $pagination = Functions::pagination($page_count,$page,$pagination_conf,$data);



        /**
         * Формирование списка задач
         */

        $tasks = $this->ToTask->GetTasks($offset,$pagination_conf['limit'],$sort.' '.$by);

            if(is_array($tasks)){

                $table = null;
                foreach ($tasks as $task){
                    $table.=' <tr><td>';
                    $admin?$table.= '<a class="edit_task" href="'.BASE_URL.'/edit/'.$task['id'].'">[✍]</a>':null;
                    $table.= $task['name'];
                    $task['edit']==1?$table.= '<span class="s_edit_admin">(отредактировано администратором)</span>':null;
                    $table.='</td><td>'.$task['email'].'</td>
                                <td>'.$task['text'].'</td>
                                <td>'.Functions::badge_status($task['status']).'</td>
                           </tr>';
                }
            }


            $message = $_SESSION['success'];
            unset($_SESSION['success']);

            include_once __DIR__."/../views/main.php";
            return true;

        }



        public function ActionLogout(){

            unset($_SESSION['admin']);
            session_destroy();
            header('Location: '.BASE_URL);

        }



}
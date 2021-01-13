<?php

class ToTask {

    protected $db = null;

    public function __construct() {

        $this->db = Db::getConnection();

    }


    /**
     * Извлечение пользователя при авторизации
     * @param $login
     * @param $password
     * @return array
     */
    public function GetUser($login, $password){
        $sql = 'SELECT * FROM users WHERE login = :login and password = :password';
        $result = $this->db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Извлечение задачи с сортировкой и пагинацией
     * @param $offset
     * @param $limit
     * @param $sort
     * @return array
     */
    public function GetTasks($offset, $limit, $sort){
        $sql = 'SELECT * FROM tasks ORDER BY '.$sort.' LIMIT :limit OFFSET :offset';
        $result = $this->db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();
        $data = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[$row['id']] = $row;
        }
        return $data;
    }


    /**
     * Добавление новой задачи
     * @param $name
     * @param $email
     * @param $text
     * @return int
     */
    public function AddTask($name,$email,$text){
        $sql = 'INSERT INTO tasks (name, email, text) VALUES (:name, :email, :text)';
        $result = $this->db->prepare($sql);

        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->execute();
        $id = $result->fetch(PDO::FETCH_ASSOC);
        return $id["id"];
    }


    /**
     * Сохранение задачи при изменении админом
     * @param $id
     * @param $name
     * @param $email
     * @param $text
     * @param $status
     * @return bool
     */
    public function EditTask($id, $name, $email, $text, $status, $edit){
        $sql = "UPDATE tasks SET name = :name, email = :email, text = :text, status = :status, edit = :edit WHERE id = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':edit', $edit, PDO::PARAM_INT);
        return $result->execute();
    }


    /**
     * Извлечение задачи по её id
     * @param $id
     * @return array
     */
    public function GetTask($id){
        $sql = 'SELECT * FROM tasks WHERE id = :id';
        $result = $this->db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }


    public function GetTaskText($text){

    }

    /**
     * Подсчет общего количества задач
     * @return int
     */
    public function CountTask(){
        $sql = 'SELECT count(id) AS count FROM tasks';
        $result = $this->db->prepare($sql);
        $result->execute();
        $row = $result->fetch();
        return $row['count'];
    }


}
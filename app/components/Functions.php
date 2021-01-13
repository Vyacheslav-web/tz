<?php

/**
 * Class Functions
 *
 * Вспомогательный класс, что бы не грузить контроллеры мусором
 *
 */

class Functions{


    /**
     * Защита запросов
     * @param $data
     * @return mixed
     */
    public static function check_security($data) {

        foreach($data as $key => $value) {

            $value=trim($value);
            if (get_magic_quotes_gpc()) $value = stripslashes($value);
            $value=htmlspecialchars($value,ENT_QUOTES);
            $value=str_replace("\r","",$value);
            $value=str_replace("\n","<br>",$value);
            $array_find = array("'",'"','/**/','0x','/*','--');
            $value = str_ireplace($array_find, '', $value);
            $data[$key]=$value;

        }

        return $data;

    }


    /**
     * Определение статуса
     * @param $status
     * @return string
     */
    public static function badge_status($status){

        switch ($status) {
            case 0:
                $type = "<span class='s_work'>Выполнено</span>";
                break;
            default:
                $type = "<span class='s_success'>В работе</span>";
                break;

        }
        return $type;

    }


    /**
     * Распарсиваем GET запрос и прогоняем через защиту
     * @param $url
     * @param null $key
     * @return bool
     */
    public static function UrlParse($url, $key = null)
    {
        $parts = parse_url($url);
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
            Functions::check_security($parts);
            if (is_null($key)) {
                return $query;
            } elseif (isset($query[$key])) {
                return $query[$key];
            }
        }

        return false;
    }


    /**
     * Обработчик сортировки
     * @param $url
     * @param $sort
     * @param null $by
     * @return mixed|string
     */
    public static function sort($url, $sort, $by = null)
    {

        if(mb_strpos($url, '?')===false) $url = '?';
        if(mb_strpos($url, 'sort=') == false){

            $url = $url.'&sort='.$sort;

        }else{

            $url = preg_replace('~sort=[a-zA-Z]+~', 'sort='.$sort, $url);
        }

        if(mb_strpos($url, 'by=') === false){

            $url = $url.'&by='.$by;

        }else{

            $url = preg_replace('~by=[a-zA-Z]+~', 'by='.$by, $url);
        }

        return $url;

    }



    /**
     * Пагинация
     * @param $page_count
     * @param $page
     * @param $pagination_conf
     * @param $data
     */

    public static function pagination($page_count, $page, $pagination_conf, $data)
    {

        $print_p = null;
        $page_left = $page - 5;
        $page_right = $page + 5;
        $page_prev = $page - 1;
        $page_next = $page + 1;

        if($page_left < 2) $page_left = 2;
        if($page_right > ($page_count - 1)) $page_right = $page_count - 1;

        if($page > 1) $pagination_conf['prev_show'] = 1;
        if($page != 1) $pagination_conf['first_show'] = 1;
        if($page < $page_count) $pagination_conf['next_show'] = 1;
        if($page != $page_count) $pagination_conf['last_show'] = 1;

        $print_p.= Functions::generateHtml($page_prev, $pagination_conf['prev_text'], $pagination_conf['prev_show'], '', $data);
        $print_p.= Functions::generateHtml(1, 1, $pagination_conf['first_show'], $pagination_conf['class_active'], $data);
        if($page_left > 2) echo $pagination_conf['separator'];
        for($i = $page_left; $i <= $page_right; $i++) {
            $page_show = 1;
            if($page == $i) $page_show = 0;
            $print_p.= Functions::generateHtml($i, $i, $page_show, 'active',$data);
        }
        if($page_right < ($page_count - 1)) echo $pagination_conf['separator'];
        if($page_count != 1) $print_p.= Functions::generateHtml($page_count, $page_count, $pagination_conf['last_show'], $pagination_conf['class_active'], $data);

        $print_p.= Functions::generateHtml($page_next, $pagination_conf['next_text'], $pagination_conf['next_show'], '', $data);

        return $print_p;
    }




    /**
     * Пагинация - отрисовка ссылок
     * @param $page
     * @param $title
     * @param $show
     * @param string $active_class
     * @param $url
     * @return bool
     */

    private function generateHtml($page, $title, $show, $active_class = '', $url)
    {

        if(mb_strpos($url, '?')===false) $url = '?';
        if(mb_strpos($url, 'page=') == false){

            $url = $url.'&page=';

        }else{

            $url = preg_replace('~page=[1-9]+~', 'page=', $url);
        }

        $l = null;

        if($show) {

            $l.= ' <li class="page-item"><a class="page-link" href="'. $url . $page.'">' . $title . '</a></li>';

        } else {

            if(!empty($active_class))
            $l.= '<li class="page-item disabled"><a class="page-link" href="'. $url . $page.'">' . $title . '</a></li>';

        }

        return $l;

    }


}
<?php


class DateManager
{
    private $date_tirage_au_sort;
    private $date_jour_j;
    private $date_aujourdhui;

    public function __construct($inscription_date, $d_day_date)
    {
        $this->date_aujourdhui = date('Y-m-d H:i:s');
        $this->date_tirage_au_sort = date('Y-m-d H:i:s', $inscription_date); // 11 décembre 2021 12h
        $this->date_jour_j = date('Y-m-d H:i:s', $d_day_date); // 4 janvier 2021 09h
    }

    public function isTirageausortDay(){
        if ($this->date_tirage_au_sort <= $this->date_aujourdhui){
            return true;
        }
        return false;
    }

    public function isJourJDay(){
        if ($this->date_jour_j <= $this->date_aujourdhui){
            return true;
        }
        return false;
    }

}
// $date = new DateManager();
// var_dump($date->isJourJDay());
// var_dump($date->isTirageausortDay());

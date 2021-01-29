<?php

class Sort
{
    private $users = [];
    private $enfants = [];
    private $papa_noel_list = [];
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
        $this->users = $this->db->query("SELECT id_user FROM user")->fetchAll();
    }


    public function insertSortIntoDatabase($array)
    {
        foreach ($array as $id_papa_noel => $id_enfant) {
            $query = $this->db->prepare("INSERT INTO papa_noel (id_papa_noel, id_enfant) VALUES (:idPapaNoel, :idEnfant)");
            $query->execute([':idPapaNoel' => $id_papa_noel, ':idEnfant' => $id_enfant]);
        }
    }

    /**
     * Indique si le tirage au sort a déjà été effectué
     * @return bool
     */
    public function isSortDone()
    {
        if (!empty($this->db->query('SELECT * FROM papa_noel')->fetch())) {
            return true;
        }
        return false;
    }

    /**
     * Tirage au sort
     * Si tirage au sort effectué --> true; sinon false
     * @return Bool
     */
    public function sort()
    {
        if (!$this->isSortDone()) {
            $this->enfants = $this->users;
            $this->papa_noel_list = [];
            foreach ($this->users as $user) {
                $this->randomize($user);
            }
            $this->insertSortIntoDatabase($this->papa_noel_list);
            return true;
        }
        return false;
    }

    /**
     * Remplir le tableau
     * @param $user
     */
    public function randomize($user)
    {
        $childkey = array_rand($this->enfants);
        $enfant = $this->enfants[$childkey]['id_user'];
        $papa = $user['id_user'];
        if ($papa == $enfant) {
            if (count($this->enfants) == 1) {
                self::sort();
            } else {
                self::randomize($user);
            }
        } else {
            $this->papa_noel_list[$papa] = $enfant;
            unset($this->enfants[$childkey]);
            if (!empty($this->enfants)) {
                array_values($this->enfants);
            }
        }
    }
}

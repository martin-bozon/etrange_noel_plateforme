<?php

class User{
 private $_id;
 private $_email;
 private $_hobby1;
 private $_hobby2;
 private $_hobby3;
 private $_pseudo;
 private $db;

 public function __construct($db)
 {
     $this->db = $db;
     $this->_id = $_SESSION['user']['id_user'];
 }

 public function addHobbies($hobby1, $hobby2, $hobby3){
   $query = $this->db->prepare("UPDATE user SET hobby1 = ? , hobby2 = ?, hobby3 = ? WHERE id_user = ?");
   if ($query->execute([$hobby1, $hobby2, $hobby3, $this->_id])){
       return true;
   }
   return false;
 }

 public function getHobbies(){
   $query = $this->db->prepare("SELECT * FROM user WHERE id_user = ?");
   $query->execute([$this->_id]);
   $result = $query->fetch(PDO::FETCH_ASSOC);

   return $result;
 }

 public function hydrate(array $donnees)
   {
     $this->_id = $donnees['id'];
     $this->_email = $donnees['email'];
     $this->_pseudo = $donnees['pseudonyme'];
     $this->_hobby1 = $donnees['hobby1'];
     $this->_hobby2 = $donnees['hobby2'];
     $this->_hobby3 = $donnees['hobby3'];
 }

 public function setId($value) {
   $this->_id = $value;
 }

 public function id(){
   return $this->_id;
 }
 public function email(){
   return $this->_email;
 }
 public function hobby1(){
   return $this->_hobby1;
 }
 public function hobby2(){
   return $this->_hobby2;
 }
 public function hobby3(){
   return $this->_hobby3;
 }

}


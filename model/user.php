<?php
class User {
    private $id, $first_name, $last_name, $user_id, $usertype, $email, $password, $win, $total, $newsletter, $elo;

    public function __construct($first_name, $last_name, $user_id, $usertype, $email, $password, $win, $total, $newsletter, $elo) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_id = $user_id;
        $this->usertype = $usertype;
        $this->email = $email;
        $this->password = $password;
        $this->win = $win;
        $this->total = $total;
        $this->newsletter = $newsletter;
        $this->elo = $elo;
    }

    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }

    public function getUserID() {
        return $this->user_id;
    }
    public function setUserID($value) {
        $this->user_id = $value;
    }

    public function getUserType() {
        return $this->usertype;
    }
    public function setUserType($value) {
        $this->usertype = $value;
    }

    public function getFirstName() {
        return $this->first_name;
    }
    public function setFirstName($value) {
        $this->first_name = $value;
    }

    public function getLastName() {
        return $this->last_name;
    }
    public function setLastName($value) {
        $this->last_name = $value;
    }

    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($value) {
        $this->email = $value;
    }

    public function getNewsletter() {
        return $this->newsletter;
    }
    public function setNewsletter($value) {
        $this->newsletter = $value;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($value) {
        $this->password = $value;
    }

    public function getWin() {
        return $this->win;
    }
    public function setWin($value) {
        $this->win = $value;
    }

    public function getTotal() {
        return $this->total;
    }
    public function setTotal($value) {
        $this->total = $value;
    }

    public function getELO() {
        return $this->elo;
    }
    public function setELO($value) {
        $this->elo = $value;
    }
}
?>
<?php

    require_once '../Config/Database.php';

    class DataModel
    {

        private $email;
        private $date;
        private $db = NULL;

        public function __construct()
        {
            $this->db = Database::connect();    
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function checkEmail()
        {
            $sql = "SELECT * FROM subs WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $this->email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return empty($result);
        }

        public function addData()
        {
            $sql = "INSERT INTO subs (email, date) VALUES (:email, :date) ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $this->email, PDO::PARAM_STR);
            $stmt->bindParam("date", $this->date, PDO::PARAM_STR);
            $stmt->execute();
        }

    }

?>
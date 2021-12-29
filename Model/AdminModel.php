<?php

    require_once '../Config/Database.php';

    class AdminModel
    {
        private $db = NULL;

        public function __construct()
        {
            $this->db = Database::connect();    
        }

        public function getAllEmails()
        {
            $sql = "SELECT * FROM subs ORDER BY date DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getEmailById($id) 
        {
            $sql = "SELECT * FROM subs WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function deleteEmail() 
        {   
            if(array_key_exists('checkbox', $_POST)) {
                foreach($_POST['checkbox'] as $checkbox){
                    $sql = "DELETE FROM subs WHERE id = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam('id', $checkbox, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
        }
    }

?>
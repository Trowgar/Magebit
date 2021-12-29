<?php
    include "../Model/DataModel.php";

    class DataController
    {
        private $model;
        private $errors = [];
        private $regex = '/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/';

        public function __construct()
        {
            $this->model = new DataModel();
        }

        public function setData($data)
        {   
            $this->model->setEmail($data['email']);
            $this->model->setDate(date("y-m-d"));
            if ($this->model->checkEmail()) {
                $this->model->addData();
            }
        }

        public function checkBtn()
        {
            
        }

        public function checkError($email, $checkbox)
        {
            if ($email == '') {
                array_push($this->errors, "Email address is required"); 
            }

            if(!preg_match($this->regex, $email)) {
                array_push($this->errors, "Please provide a valid e-mail address"); 
            }

            if (strrchr($email, '.') == '.co') {
                array_push($this->errors, "We are not accepting subscriptions from Colombia emails.");
            }

            if ($checkbox == false) {
                array_push($this->errors, "You must accept the terms and conditions"); 
            }
            
            if (!empty($this->errors)) {
                return true;
            }
        }

        public function getError()
        {
            return $this->errors;
        }
     
    }

?>

<?php

    include "../Model/AdminModel.php";

    class AdminController
    {  
        private $model;
        private $emails;

        public function __construct()
        {
            $this->model = new AdminModel();
            $this->emails = $this->model->getAllEmails();
        }

        public function checkBtn()
        {
            if (isset($_POST['search'])) {
                $this->searchEmails(trim($_POST['input']));
                $this->sortData($_POST['sort']);
                $this->domainFilter($_POST['filter']);
            }
        
            if (isset($_POST['delete'])) {
                $this->model->deleteEmail($_POST['delete']);
                $this->emails = $this->model->getAllEmails();
            }
        
            if (isset($_POST['export'])) {
                $this->exportData();    
            }
        }

        public function displayEmails()
        {   
            foreach ($this->emails as $value) {
                echo '
                    <tr>
                        <td> '. $value["id"] .' </td>
                        <td> '. $value["email"] .' </td>
                        <td> '. $value["date"] .' </td> 
                        <td> <input type="checkbox" form="admin-form" value="'.$value['id'].'" name="checkbox[]"> </td>
                    </tr>            
                ';                
            }
        }

        public function displayDomains()
        {   
            $domains = [];
            foreach ($this->emails as $value) {
                $domain = explode('@', $value['email']);
                array_push($domains, $domain[1]);             
            }
            $domains = array_unique($domains);
            foreach ($domains as $domain) {
                echo '
                    <option value="'.$domain.'">
                        '.$domain.'
                    </option>
                '; 
            }
        }

        private function domainFilter($domain) {
            if ($domain != "") {
                foreach ($this->emails as $key => $item) {
                    $currDomain = explode('@', $item['email']);
                    if ($currDomain[1] != $domain) {
                      unset($this->emails[$key]);
                    }
                }
            } 
        }

        private function searchEmails($email)
        {  
            if ($email != "") {
                foreach ($this->emails as $key => $item) {
                    if ($item['email'] != $email) {
                      unset($this->emails[$key]);
                    }
                }
            } else {
                $this->emails = $this->model->getAllEmails();
            }
        }

        private function sortData($sort)
        {   
            if (!empty($this->emails)) {
                $param = explode('-', $sort);
                $sort_arr = array();
                foreach($this->emails as $email){
                    foreach($email as $key=>$value){
                        $sort_arr[$key][] = $value;
                    }
                }            
                if ($param[1] == 'asc') {
                    array_multisort($sort_arr[$param[0]], SORT_ASC, $this->emails);
                } else {
                    array_multisort($sort_arr[$param[0]], SORT_DESC, $this->emails);
                }
            }
        }

        private function exportData() 
        {
            if(array_key_exists('checkbox', $_POST)) {
                $filename = "subs.csv";
                $del = ";";
                $f = fopen('php://memory', 'w');

                $fields = array('Id','Email', 'Date');
                fputcsv($f, $fields, $del);

                foreach ($_POST['checkbox'] as $id) {
                    $email = $this->model->getEmailById($id);
                    $data = array($email['id'], $email['email'], $email['date']);
                    fputcsv($f, $data, $del);
                }

                fseek($f, 0);

                header('Content-Type: txt/csv');
                header('Content-Disposition: attachment; filename="' . $filename . '";');

                fpassthru($f);
            
                exit;
            }
        }
        
    }

?>
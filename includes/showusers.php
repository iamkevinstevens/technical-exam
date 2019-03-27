<?php
    class ShowUser extends GetUser{
        public function showUsers() {
           $datas = $this->getUsers();
           foreach($datas as $data) {
               echo $data['firstname'].'<br>';
               echo $data['lastname'].'<br>';
           }
        }
    }
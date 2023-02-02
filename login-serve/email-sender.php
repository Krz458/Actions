<?php 
//Not using
    class EmailSender{
        private $email;
        private $subject = 'Account activation on KrzychuCraft.';
        private $message = 'You have to confirm our account.';

        public function getEmail(String $email) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                return $this->email = $email;
            }

        }

        public function sendEmail($email) {
            
            mail($this->getEmail($email), $this->subject, $this->message);
        }
    }

<?php
    class Avatar{
        private String $fName;
        private String $tmpName;

      public function check_avatar_err_mess($avatar){
            if($avatar['error'] > 0){
                switch($avatar['error']){
                    case 1:
                        set_error_message('avatar', 'to_learge');
                        returnSite();
                        return false;
                    break;
    
                    case 2:
                        set_error_message('avatar', 'to_learge');
                        returnSite();
                        return false;
                    break;
    
                    case 3:
                        set_error_message('avatar', 'upload_not_complete');
                        returnSite();
                        return false;
                    break;
    
                    case 4:
                        //set_error_message('avatar', 'no_upload');
                        //returnSite();
                        return false;
                    break;
    
                    default:
                        set_error_message('avatar', 'default');
                        return false;
                        returnSite();
                    break;
                        
                }
            } else {
                $this->fName = $avatar['name'];
                $this->tmpName = $avatar['tmp_name'];
                return true;
            }
        }

        public function saveAvatar(String $login){
            //$login = 'kacper212';
            $location = 'avatars' . '/' . $login .'.png';
            if(is_uploaded_file($this->tmpName)){
                if(move_uploaded_file($this->tmpName, $location)){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

<?php
    class ImageSave{
        private String $tmpName;

        private function set_error_message(String $option){
                    switch($option){
                        case 'to_learge':
                            $_SESSION['bad_avatar'] = 'The file size is too learge';
                        break;
    
                        case 'upload_not_complete':
                            $_SESSION['bad_avatar'] = 'The file has not complete uploaded.';
                        break;
    
                        case 'no_upload':
                            $_SESSION['bad_avatar'] = 'The file is is not uploded.';
                        break;
                    }
        }
    

        public function check_image_err_mess($image){
            if($image['error'] > 0){
                switch($image['error']){
                    case 1:
                        $this->set_error_message('avatar', 'to_learge');
                        returnSite();
                        return false;
                    break;
    
                    case 2:
                        $this->set_error_message('avatar', 'to_learge');
                        returnSite();
                        return false;
                    break;
    
                    case 3:
                        $this->set_error_message('avatar', 'upload_not_complete');
                        returnSite();
                        return false;
                    break;
    
                    case 4:
                        //$this->set_error_message('avatar', 'no_upload');
                        //returnSite();
                        return false;
                    break;
    
                    default:
                        $this->set_error_message('avatar', 'default');
                        return false;
                        returnSite();
                    break;
                        
                }
            } else {
                $this->tmpName = $image['tmp_name'];
                return true;
            }
        }

        public function saveImage(String $id){
            $location = 'images' . '/' . $id .'.png';
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

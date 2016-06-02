<?php

class Controller {
    public function getQueryType(){
        if (isset($_POST['reminder']) && $_POST['reminder'] != '') {
            return 'insert';}

        if (isset($_POST['done'])){
            return 'update';
        }
        return null;
    }

    public function setSuccessMessage($success, $post)
    {
        $successMessage = '';
        if ($success && $post == 'update') {
            $successMessage = 'Changes saved!';
        } elseif($post == 'update') {
            $successMessage = 'Failed to make changes.';
        }
        elseif ($success && $post == 'insert') {
            $successMessage = "Your reminder has been saved!";
        } elseif($post == 'insert') {
            $successMessage = "Oh no, your reminder was not saved, try again!";
        }
        return $successMessage;
    }
}

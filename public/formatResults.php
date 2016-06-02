<?php

class formatResults
{
    public $template;


    public function templateResults(array $todoList)
    {
        $this->template[] = '<form method="post">';
        foreach ($todoList as $row => $field) {
            $this->template[] = '<h6>' . $field['date'] . '</h6><h3>' . $field['id'] . '. ' . $field['message'] . '</h3><br>';
            $done = ($field['done'] == '0' ? '' : 'checked');
            $this->template[] = 'Done? <input type="checkbox" name="done[]" value="' . $field['id'] . '" ' . $done . '>';
        }
        $this->template[] = '<div><input type="submit"></div>';
        $this->template[] = '</form>';
        return $this->template;
    }

}
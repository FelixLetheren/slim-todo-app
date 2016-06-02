<?php

class todoData
{
    private $sqlQuery;
    private $db;
    private $reminderList;

    public function  __construct($db)
    {
        $this->db = $db;
    }

    public function selectAndRunSqlQuery($queryType)
    {
        if ($queryType == 'insert'){
            $this->setSqlInsert($_POST['reminder']);
            $success = $this->runQuery();
        } elseif ($queryType == 'update') {
            $this->setSqlUpdate($_POST['done']);
            $success = $this->runQuery();
        } else {
            $success = null;
        }
        return $success;
    }

    private function runQuery()
    {
        try {
            $this->db->query($this->sqlQuery);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * runs sql statement property
     */
    public function setSqlInsert($reminder)
    {
        $this->sqlQuery = 'INSERT INTO todo (message)
        VALUES (\'' . $reminder . '\');';
    }

    public function setSqlUpdate($id)
    {
        $ids = implode(', ', $id);
        $this->sqlQuery = '
        UPDATE todo
        SET done = \'1\'
        WHERE id IN (' . $ids . ');
        UPDATE todo
        SET done = \'0\'
        WHERE id NOT IN (' . $ids . ');';
    }

    public function getSqlReminders()
    {
        $this->sqlQuery = "SELECT todo.id,
        todo.message, todo.done, todo.date
        FROM todo;";
        $query = $this->db->query($this->sqlQuery);
        $this->reminderList = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->reminderList;
    }
}
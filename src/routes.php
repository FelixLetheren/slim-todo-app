<?php
// Routes

$app->get('/', function ($request, $response, $args) {

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/todo', function ($request, $response, $args) {
    include 'dbconn.php';
    include 'dbupdate.php';
    include 'formatResults.php';

    $model = new todoData($db);
    $successMessage = "";
    $todoList = $model->getSqlReminders();

    // Render index view
    return $this->renderer->render($response, 'todo.phtml', ['todoList' => $todoList, 'successMessage' => $successMessage]);
});


//post todo
$app->post('/todo', function ($request, $response, $args) {
    include 'dbconn.php';
    include 'dbupdate.php';
    include 'formatResults.php';
    include 'controller.php';
    // instantiate the model handling class and the controller class
    $model = new todoData($db);
    $controller = new Controller();

    // Define whether to call an insert or update query
    $queryType = $controller->getQueryType();
    // Run an insert or update query, returns true or false
    $resultOfQuery = $model->selectAndRunSqlQuery($queryType);
    // set a success or failure message
    $successMessage = $controller->setSuccessMessage($resultOfQuery, $queryType);
    // Generate to do list
    $todoList = $model->getSqlReminders();

    // Render index view
    return $this->renderer->render($response, 'todo.phtml', ['todoList' => $todoList, 'successMessage' => $successMessage]);
});
// WOULD BE SIMPLER BY ADDING A NEW FILEPATH

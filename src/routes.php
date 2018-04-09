<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../src/controllers/TableController.php';

$app->post('/login', function (Request $request, Response $response) {

});

$app->post('/registration', function (Request $request, Response $response) {
    
});


$app->get('/{className}[/[{id}]]', function (Request $request, Response $response) {
    $className = $request->getAttribute('className');
    $id        = $request->getAttribute('id') ? $request->getAttribute('id') : "ALL";
    $object = TableController::handleSelect($className, $id);
    return !is_numeric($object) ? $response->withJson($object) : $response->withStatus($object);
});

$app->post('/{className}/add', function (Request $request, Response $response) {
    $className = $request->getAttribute('className');
    $body      = $request->getParsedBody();
    return $response->withStatus(TableController::handleInsert($className, $body));
});

$app->put('/{className}/update/{id}', function (Request $request, Response $response) {
    $className = $request->getAttribute('className');
    $body      = $request->getParsedBody();
    $id        = $request->getAttribute('id');
    return $response->withStatus(TableController::handleUpdate($className, $body, $id));
});

$app->delete('/{className}/delete/{id}', function (Request $request, Response $response) {
    $className = $request->getAttribute('className');
    $id        = $request->getAttribute('id');
    return $response->withStatus(TableController::handleDelete($className, $id));
});
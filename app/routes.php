<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Authorize\LoginAction;
use App\Application\Actions\Authorize\LogoutAction;
use App\Application\Actions\Authorize\RegisterAction;
use App\Application\Actions\Authorize\EmailValidationAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/authorize', function (Group $group) {
        $group->get('/validate/email', EmailValidationAction::class);
        $group->get('/register', RegisterAction::class);
        $group->get('/logout', LogoutAction::class);
        $group->get('/login', LoginAction::class);
    });
};

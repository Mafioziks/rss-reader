<?php

namespace App\Application\Actions\Authorize;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Authorize\AuthorizeAction;
use App\Domain\User\User;

class RegisterAction extends AuthorizeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // TODO: Transform to post request
        $params = $this->request->getQueryParams();

        $user = new User(
            null,
            $params['username'],
            $params['first_name'],
            $params['last_name'],
            $params['email'],
            $params['password']
        );

        $this->user_repository->store($user);

        return $this->respondWithData(['user' => $user->jsonSerialize()])->withStatus(201);
    }
}
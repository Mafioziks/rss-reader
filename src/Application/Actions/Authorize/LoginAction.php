<?php

namespace App\Application\Actions\Authorize;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Authorize\AuthorizeAction;

class LoginAction extends AuthorizeAction
{
    /**
     * @return Response
     */
    protected function action(): Response
    {
        // TODO: Transform to post request
        $params = $this->request->getQueryParams();
        $user   = $this->user_repository->findAuthorized($params['email'], $params['password']);

        if (null === $user) {
            return $this->respondWithData(['error' => 'wrong creditionals'])->withStatus(401);
        }

        return $this->respondWithData([
            'user' => [
                'first_name' => $user->getFirstName(),
                'last_name'  => $user->getLastName(),
            ],
        ]);
    }
}
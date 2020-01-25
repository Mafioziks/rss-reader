<?php

namespace App\Application\Actions\Authorize;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Authorize\AuthorizeAction;

class EmailValidationAction extends AuthorizeAction
{
    protected function action(): Response
    {
        // TODO: transform for POST request
        $params = $this->request->getQueryParams();

        return $this->respondWithData(['valid' => !$this->user_repository->emailTaken($params['email'])]);
    }
}
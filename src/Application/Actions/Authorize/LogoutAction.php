<?php

namespace App\Application\Actions\Authorize;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Authorize\AuthorizeAction;

class LogoutAction extends AuthorizeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        

        return $this->respondWithData(['action' => 'logout']);
    }
}
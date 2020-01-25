<?php

namespace App\Application\Actions\Authorize;

use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;

abstract class AuthorizeAction extends Action
{
    /** @var UserRepositori $user_repository */
    protected $user_repository;

    /**
     * @param LoggerInterface $logger
     * @param UserREporitory  $user_repository
     */
    public function __construct(LoggerInterface $logger, UserRepository $user_repository)
    {
        parent::__construct($logger);
        $this->user_repository = $user_repository;
    }
}
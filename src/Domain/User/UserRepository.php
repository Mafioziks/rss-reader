<?php
declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

    /**
     * @param string $email
     * @param string $password
     * 
     * @return null|User
     */
    public function findAuthorized(string $email, string $password): ?User;

    /**
     * @param string $email
     * 
     * @return bool
     */
    public function emailTaken(string $email): bool;
}

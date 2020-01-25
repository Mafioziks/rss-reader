<?php

namespace App\Domain\User;

use PDO;
use App\Domain\User\User;
use App\Domain\Repository as Base;

class Repository extends Base implements UserRepository
{
     /**
     * @return User[]
     * @inheritdocs
     */
    public function findAll(): array
    {
        $statement = $this->connection->prepare('SELECT * FROM users');
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, User::class);
        
        return $statement->fetchAll();
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     * @inheritdocs
     */
    public function findUserOfId(int $id): User
    {
        
    }

    /**
     * @param User $user
     */
    public function store(User $user): bool
    {
        $affected_rows = $this->connection->prepare(
            'INSERT INTO
                users
            SET
                username=:username,
                first_name=:first_name,
                last_name=:last_name,
                email=:email,
                password=:password'
        )->execute([
            'username'   => $user->getUsername(),
            'first_name' => $user->getFirstName(),
            'last_name'  => $user->getLastName(),
            'email'      => $user->getEmail(),
            'password'   => $user->getPassword(),
        ]);

        if (0 === $affected_rows) {
            // TODO: errors
            return false;
        }

        $user->setId((int)$this->connection->lastInsertId());

        return true;
    }

    /**
     * @param string $email
     * @param string $password
     * 
     * @return null|User
     * 
     * @throws Exception
     */
    public function findAuthorized(string $email, string $password): ?User
    {
        $statement = $this->connection->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute(['email' => $email]);

        $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, User::class);
        $results = $statement->fetchAll();
        $result_count = count($results);

        if (0 === $result_count) {
            return null;
        }

        if ($result_count > 1) {
            throw new Exception('Data problem in database!');
        }

        $user = current($results);

        if (\password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

    /**
     * @param string $email
     * 
     * @return bool
     */
    public function emailTaken(string $email): bool
    {
        $statement = $this->connection->prepare('SELECT email FROM users WHERE email = :email');
        $statement->execute(['email' => $email]);

        return count($statement->fetchAll()) > 0;
    }
}
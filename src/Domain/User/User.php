<?php
declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;

class User implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @param int|null  $id
     * @param string    $username
     * @param string    $firstName
     * @param string    $lastName
     */
    public function __construct(
        ?int $id           = null,
        ?string $username  = null,
        ?string $firstName = null,
        ?string $lastName  = null,
        ?string $email     = null,
        ?string $password  = null
    ) {
        $this->id         = $id;
        $this->username   = null === $username ? null : strtolower($username);
        $this->first_name = null === $firstName ? null : ucfirst($firstName);
        $this->last_name  = null === $lastName ? null :  ucfirst($lastName);
        $this->email      = $email;
        $this->password   = null === $password ? null : \password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return null === $this->id ? null : (int)$this->id;
    }

    /**
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'username'  => $this->username,
            'firstName' => $this->first_name,
            'lastName'  => $this->last_name,
            'email'     => $this->email,
            'password'  => $this->password,
        ];
    }
}

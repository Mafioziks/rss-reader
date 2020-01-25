<?php

namespace App\Domain;

use PDO;

abstract class Repository
{
    protected $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
}
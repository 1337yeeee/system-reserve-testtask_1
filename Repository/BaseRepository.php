<?php

namespace Repository;

use PDO;

abstract class BaseRepository implements Repository
{
    public function __construct(protected PDO $conn)
    {
        // pass
    }
}

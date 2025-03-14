<?php

namespace Repository;

use Model\Model;

interface Repository
{
    /**
     * Find a single entity by id
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model;

    /**
     * Get all enteties
     * @return Model[]
     */
    public function findAll(): array;
}

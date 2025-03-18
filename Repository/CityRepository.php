<?php

namespace Repository;

use Model\Model;
use Model\Cities;

class CityRepository extends BaseRepository
{
    /**
     * @param int $id
     * @return Cities
     */
    public function find(int $id): Model
    {
        $table = Cities::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table}
            where id = :id
            limit 1;
        SQL);
        $statement->bindParam('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new Cities($result);
    }

    /**
     * @return Cities[]
     */
    public function findAll(): array
    {
        $entities = [];
        $table = Cities::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table};
        SQL);
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new Cities($row);
        }

        return $entities;
    }
}


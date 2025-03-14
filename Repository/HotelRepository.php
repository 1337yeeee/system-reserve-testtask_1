<?php

namespace Repository;

use Model\Hotels;

class HotelsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Hotels::class;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Hotels
    {
        $entityClass = $this->getEntityClass();
        $table = $entityClass::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table}
            where id = :id
            limit 1;
        SQL);
        $statement->bindParam('id', $id, \PDO::PARAM_INT);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new $entityClass($result);
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $entities = [];
        $entityClass = $this->getEntityClass();
        $table = $entityClass::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table};
        SQL);

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new $entityClass($row);
        }

        return $entities;
    }
}

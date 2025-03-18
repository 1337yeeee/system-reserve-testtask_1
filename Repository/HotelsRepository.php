<?php

namespace Repository;

use Model\Cities;
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
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new $entityClass($result);
    }

    public function findWithCity(int $id): Hotels
    {
        $entityClass = $this->getEntityClass();
        $table = $entityClass::TABLE;
        $citiesTable = Cities::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select 
                h.*, 
                ci.country_id,
                ci.name as city_name
            from `{$table}` h
            join `{$citiesTable}` ci on h.city_id = ci.id
            where h.id = :hotel_id;
        SQL);
        $statement->bindParam('hotel_id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        $hotel = new $entityClass($result);
        $city = new Cities([
            'id' => 'city_id',
            'name' => 'city_name',
            'country_id' => 'country_id',
        ]);
        $hotel->setCity($city);

        return $hotel;
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
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new $entityClass($row);
        }

        return $entities;
    }
}

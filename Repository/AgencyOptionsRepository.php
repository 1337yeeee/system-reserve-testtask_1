<?php

namespace Repository;

use Model\Model;
use Model\AgencyHotelOptions;

class AgencyOptionsRepository extends BaseRepository
{
    /**
     * @param int $id
     * @return AgencyHotelOptions
     */
    public function find(int $id): Model
    {
        $table = AgencyHotelOptions::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table}
            where id = :id
            limit 1;
        SQL);
        $statement->bindParam('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new AgencyHotelOptions($result);
    }

    /**
     * @return AgencyHotelOptions[]
     */
    public function findAll(): array
    {
        $entities = [];
        $table = AgencyHotelOptions::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table};
        SQL);
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new AgencyHotelOptions($row);
        }

        return $entities;
    }

    public function findAllByHotelId(int $hotelId): array
    {
        $entities = [];

        $table = AgencyHotelOptions::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from `{$table}`
            where hotel_id = :hotel_id;
        SQL);
        $statement->bindParam('hotel_id', $hotelId, \PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new AgencyHotelOptions($row);
        }

        return $entities;
    }
}

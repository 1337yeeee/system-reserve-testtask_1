<?php

namespace Repository;

use Model\Model;
use Model\HotelAgreements;

class HotelAgreementsRepository extends BaseRepository
{
    /**
     * @param int $id
     * @return HotelAgreements
     */
    public function find(int $id): Model
    {
        $table = HotelAgreements::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table}
            where id = :id
            limit 1;
        SQL);
        $statement->bindParam('id', $id, \PDO::PARAM_INT);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new HotelAgreements($result);
    }

    /**
     * @return HotelAgreements[]
     */
    public function findAll(): array
    {
        $entities = [];
        $table = HotelAgreements::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table};
        SQL);

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new HotelAgreements($row);
        }

        return $entities;
    }

    /**
     * @return HotelAgreements[]
     */
    public function findByHotelId(int $hotelId): array
    {
        $entities = [];
        $table = HotelAgreements::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table}
            where hotel_id = :hotel_id;
        SQL);
        $statement->bindParam('hotel_id', $hotelId, \PDO::PARAM_INT);

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new HotelAgreements($row);
        }

        return $entities;
    }
}

<?php

namespace Repository;

use Model\Model;
use Model\Agencies;
use Model\AgencyHotelOptions;

class AgencyRepository extends BaseRepository
{
    /**
     * @param int $id
     * @return Agencies
     */
    public function find(int $id): Model
    {
        $table = Agencies::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table}
            where id = :id
            limit 1;
        SQL);
        $statement->bindParam('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new Agencies($result);
    }

    /**
     * @return Agencies[]
     */
    public function findAll(): array
    {
        $entities = [];
        $table = Agencies::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select *
            from {$table};
        SQL);
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new Agencies($row);
        }

        return $entities;
    }

    public function findAllByHotelId(int $hotelId): array
    {
        $entities = [];

        $table = Agencies::TABLE;
        $agencyOptionsTable = AgencyHotelOptions::TABLE;

        $statement = $this->conn->prepare(<<<SQL
            select distinct a.*
            from `{$table}` a
            left join `{$agencyOptionsTable}` ao on ao.agency_id = a.id
            where ao.hotel_id = :hotel_id;
        SQL);
        $statement->bindParam('hotel_id', $hotelId, \PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new Agencies($row);
        }

        return $entities;
    }
}


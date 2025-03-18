<?php

require_once 'vendor/autoload.php';

use \Repository\HotelsRepository;
use \Repository\CityRepository;
use \Repository\AgencyRepository;
use \Repository\AgencyRulesRepository;
use \Repository\AgencyOptionsRepository;
use \Repository\HotelAgreementsRepository;
use \Services\HotelAssembler;
use \Services\AgencyAssembler;

define('MYSQL_HOST', 'mysql');
define('MYSQL_USER', $_ENV['MYSQL_USER']);
define('MYSQL_PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('MYSQL_DB', $_ENV['MYSQL_DATABASE']);

$conn = new PDO('mysql:host='.MYSQL_HOST.';port=3306;dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASSWORD);

$hotel_id = $_GET['hotel_id'] ?? 1; // отель для которого делаем проверку

echo '<ul>';
foreach ($conn->query('SELECT * FROM `agencies`') as $row) {
    echo '<li><strong>'.$row['id'].'</strong> '.$row['name'].'</li>';
}
echo '</ul>';

$hotelRepository = new HotelsRepository($conn);
$cityRepository = new CityRepository($conn);
$hotelAgreementsRepository = new HotelAgreementsRepository($conn);
$agencyRepository = new AgencyRepository($conn);
$agencyOptionsRepository = new AgencyOptionsRepository($conn);

/** @var \Model\Hotels */
$hotel = $hotelRepository->find($hotel_id);

$service = new \Services\AgencyHotelRulesService(
    new HotelAssembler(
        $cityRepository,
        $hotelAgreementsRepository,
        $hotel
    ),
    new AgencyAssembler(
        $agencyRepository,
        $agencyOptionsRepository,
        $hotel
    ),
    new AgencyRulesRepository($conn)
);

$agencies = $service->getPassedAgncies();

foreach ($agencies as $element) {
    echo $element['agency']->name . ": " . $element['rule']->manager_message;
    echo "<br>";
}

?>
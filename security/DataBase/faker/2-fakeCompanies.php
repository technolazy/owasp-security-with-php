<?php

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use \security\Models\MySQLISingleton;

$mysqli = new MySQLISingleton();

$faker = Faker\Factory::create();

$fakeCompanies = 10;

$mysqlValues = $sqliteValues = [];

for ($i = 0; $i < $fakeCompanies; $i++) {
    $name = $faker->company;
    $mysqlName = $mysqli->real_escape_string($name);
    $sqliteName = SQLite3::escapeString($name);

    $domain = $faker->domainName;
    $mysqlDomain = $mysqli->real_escape_string($domain);
    $sqliteDomain = SQLite3::escapeString($domain);

    $address = $faker->address;
    $mysqlAddress = $mysqli->real_escape_string($address);
    $sqliteAddress = SQLite3::escapeString($address);

    $city = $faker->city;
    $mysqlCity = $mysqli->real_escape_string($city);
    $sqliteCity = SQLite3::escapeString($city);

    $state = $faker->state;
    $mysqlState = $mysqli->real_escape_string($state);
    $sqliteState = SQLite3::escapeString($state);

    $phone = $faker->unique()->numerify('##########');
    $mysqlQuery = "INSERT INTO companies (`id`, `name`, `website`, `address`, `city`, `state`, `phone`) VALUES
              (null, '$mysqlName', '$mysqlDomain', '$mysqlAddress', '$mysqlCity', '$mysqlState', '$phone')";
    $sqliteQuery = "INSERT INTO companies (`id`, `name`, `website`, `address`, `city`, `state`, `phone`) VALUES
                  (null,'$sqliteName', '$sqliteDomain', '$sqliteAddress', '$sqliteCity', '$sqliteState', '$phone')";

    $mysqlValues[] = $mysqlQuery;
    $sqliteValues[] = $sqliteQuery;
}

// Generate SQL files for MySQL

$valueString = implode(";" . PHP_EOL, $mysqlValues);
$valueString .= ";";
$valueString .= PHP_EOL . "--//@UNDO" . PHP_EOL .
"SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE companies;
SET FOREIGN_KEY_CHECKS = 1;" . PHP_EOL . "--//";

$directorySeeds = dirname(__DIR__) . "/deltas/seeds/mysql/";
$seedsFile = $directorySeeds . "12-companySeeds.sql";
if (!is_dir($directorySeeds)) {
    mkdir($directorySeeds, 0775, true);
}

if (!file_exists($seedsFile)) {
    touch($seedsFile);
}
file_put_contents($seedsFile, $valueString);

// Generate SQL files for SQLite

$valueString = implode(";" . PHP_EOL, $sqliteValues);
$valueString .= ";";
$valueString .= PHP_EOL . "--//@UNDO" . PHP_EOL . "PRAGMA foreign_keys=OFF;
delete from companies;
PRAGMA foreign_keys=ON;" . PHP_EOL . "--//";

$directorySeeds = dirname(__DIR__) . "/deltas/seeds/sqlite/";
if (!is_dir($directorySeeds)) {
    mkdir($directorySeeds, 0775, true);
}

$seedsFile = $directorySeeds . "12-companySeeds.sql";

if (!file_exists($seedsFile)) {
    touch($seedsFile);
}
file_put_contents($seedsFile, $valueString);

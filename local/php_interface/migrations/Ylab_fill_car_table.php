<?php
use Bitrix\Main\Application;
use Bitrix\Main\Db\SqlQueryException;
use Bitrix\Main\Loader;
use Ylab\Study\Entity\CarTable;
use Ylab\Study\Entity\ColorTable;

/**
 * Описание миграции для добавления автомобилей
 **/
class FillCarTableMigration
{
    public function up()
    {
        try {
            Loader::includeModule('ylab.study');
            $colorList = ColorTable::getList();            
            $colors = [];
            while ($color = $colorList->fetch()) {
                $colors[$color['CODE']] = $color['NAME'];
            }
            $cars = [
                [
                    'BRAND' => 'BMW',
                    'MODEL' => 'X3',
                    'DATE_PRODUCTION' => '2015-05-01',
                    'PAYLOAD' => 700,
                    'COLOR_ID' => $colors['white'],
                    'COMMERCIAL' => false,
                ],
                [
                    'BRAND' => 'Toyota',
                    'MODEL' => 'Camry',
                    'DATE_PRODUCTION' => '2010-03-15',
                    'PAYLOAD' => 600,
                    'COLOR_ID' => $colors['green'],
                    'COMMERCIAL' => true,
                ],
                [
                    'BRAND' => 'Mercedes-Benz',
                    'MODEL' => 'S-Class',
                    'DATE_PRODUCTION' => '2017-02-01',
                    'PAYLOAD' => 800,
                    'COLOR_ID' => $colors['blue'],
                    'COMMERCIAL' => false,
                ],
                [
                    'BRAND' => 'Nissan',
                    'MODEL' => 'GTR',
                    'DATE_PRODUCTION' => '2018-08-10',
                    'PAYLOAD' => 500,
                    'COLOR_ID' => $colors['red'],
                    'COMMERCIAL' => false,
                ],
                [
                    'BRAND' => 'Honda',
                    'MODEL' => 'Accord',
                    'DATE_PRODUCTION' => '2020-11-01',
                    'PAYLOAD' => 650,
                    'COLOR_ID' => $colors['white'],
                    'COMMERCIAL' => true,
                ],
                [
                    'BRAND' => 'Ford',
                    'MODEL' => 'Mustang',
                    'DATE_PRODUCTION' => '2019-05-25',
                    'PAYLOAD' => 500,
                    'COLOR_ID' => $colors['red'],
                    'COMMERCIAL' => false,
                ],
                [
                    'BRAND' => 'Mazda',
                    'MODEL' => 'CX-5',
                    'DATE_PRODUCTION' => '2018-03-10',
                    'PAYLOAD' => 650,
                    'COLOR_ID' => $colors['blue'],
                    'COMMERCIAL' => true,
                ],
                [
                    'BRAND' => 'Kia',
                    'MODEL' => 'Rio',
                    'DATE_PRODUCTION' => '2016-11-05',
                    'PAYLOAD' => 520,
                    'COLOR_ID' => $colors['white'],
                    'COMMERCIAL' => true,
                ],
                [
                    'BRAND' => 'Hyundai',
                    'MODEL' => 'Elantra',
                    'DATE_PRODUCTION' => '2014-09-20',
                    'PAYLOAD' => 580,
                    'COLOR_ID' => $colors['green'],
                    'COMMERCIAL' => false,
                ],
                [
                    'BRAND' => 'Audi',
                    'MODEL' => 'RS7',
                    'DATE_PRODUCTION' => '2021-01-01',
                    'PAYLOAD' => 700,
                    'COLOR_ID' => $colors['white'],
                    'COMMERCIAL' => false,
                ],
            ];

            foreach ($cars as $car) {
                CarTable::add($car);
            }
        } catch (SqlQueryException $e) {
            echo $e->getMessage();
        }
    }

    public function down()
    {
        try {
            Loader::includeModule('ylab.study');

            $connection = Application::getConnection();
            $tableName = CarTable::getTableName();

            if ($connection->isTableExists($tableName)) {
                $connection->truncateTable($tableName);
            }
        } catch (SqlQueryException $e) {
            echo $e->getMessage();
        }
    }
}

<?php
use Bitrix\Main\Application;
use Bitrix\Main\Db\SqlQueryException;
use Bitrix\Main\Loader;
use Ylab\Study\Entity\CarTable;

/**
 * Описание миграции для создания таблицы автомобилей
 **/
class CreateCarTableMigration
{
       public function up()
    {
        try {
            Loader::includeModule('ylab.study');
    
            $connection = Application::getConnection();
            $tableName = CarTable::getTableName();
    
            if (!$connection->isTableExists($tableName)) {
                $connection->createTable($tableName, CarTable::getEntity()->getFields());
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
                $connection->dropTable($tableName);
            }
        } catch (SqlQueryException $e) {
            echo $e->getMessage();
        }
    }
}

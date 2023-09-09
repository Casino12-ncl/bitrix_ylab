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
                $connection->queryExecute("
                    CREATE TABLE `{$tableName}` (
                        `ID` INT(11) NOT NULL AUTO_INCREMENT,
                        `BRAND` VARCHAR(255) NOT NULL,
                        `MODEL` VARCHAR(255) NOT NULL,
                        `DATE_PRODUCTION` DATE NOT NULL,
                        `PAYLOAD` INT(11),
                        `COLOR_ID` INT(11),
                        `COMMERCIAL` TINYINT(1) DEFAULT 0 NOT NULL,
                        PRIMARY KEY (`ID`),
                        CONSTRAINT `FK_COLOR_ID` FOREIGN KEY (`COLOR_ID`) REFERENCES color (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
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

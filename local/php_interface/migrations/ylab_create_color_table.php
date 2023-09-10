<?php
use Bitrix\Main\Application;
use Bitrix\Main\Db\SqlQueryException;
use Bitrix\Main\Loader;
use Ylab\Study\Entity\ColorTable;

/**
 * Описание миграции для создания таблицы цвета автомобилей
 **/
class CreateColorTableMigration
{
    public function up()
{
    try {
        Loader::includeModule('ylab.study');

        $connection = Application::getConnection();
        $tableName = ColorTable::getTableName();

        if (!$connection->isTableExists($tableName)) {
            $connection->createTable($tableName, ColorTable::getEntity()->getFields());
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
            $tableName = ColorTable::getTableName();

            if ($connection->isTableExists($tableName)) {
                $connection->dropTable($tableName);
            }
        } catch (SqlQueryException $e) {
            echo $e->getMessage();
        }
    }
}

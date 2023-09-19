<?php

namespace Sprint\Migration;
use Bitrix\Highloadblock\HighloadBlockTable;

class AddContentGoat extends Version
{
    public function up()
    {
        if (!\Bitrix\Main\Loader::includeModule('highloadblock')) {
            throw new \Bitrix\Main\LoaderException('Модуль highloadblock не установлен.');
        }
        
        $hlblockId = 3; 
        $hlblockData = HighloadBlockTable::getById($hlblockId)->fetch();
        if ($hlblockData) {
            $entity = HighloadBlockTable::compileEntity($hlblockData);
            $entityDataClass = $entity->getDataClass();

        
            $result = $entityDataClass::add([
                'UF_TYPE' => 'коза',
                'UF_KLICHKA' => 'марфена',
                'UF_GENDER' => 'женский',
                'UF_DATE' => '1989-01-02', 
                'UF_PLACE' => 'Деревня',
            ]);

            if (!$result->isSuccess()) {
                throw new \Exception('Ошибка при добавлении элмента: ' . implode(', ', $result->getErrorMessages()));
            }
        } else {
            throw new \Exception('Highload-блок с ID ' . $hlblockId . ' не найден');
        }
    }

    public function down()
    {
        $hlblock_id = 3; 
        $hlblock = HighloadBlockTable::getById($hlblock_id)->fetch();

        $entity = HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $filter = array(
            'UF_TYPE' => 'коза',
            'UF_KLICHKA' => 'марфена',
            'UF_GENDER' => 'женский',
            'UF_DATE' => '02.01.1989',
            'UF_PLACE' => 'Деревня',
        );

        $record = $entity_data_class::getList(array(
            'select' => array('ID'),
            'filter' => $filter,
        ))->fetch();

        if ($record) {
            $entity_data_class::delete($record['ID']);
        }
    }
}
<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Ylab\Study\Entity\CarTable;
class CarsList extends CBitrixComponent
{
    public $IBLOCK_ID = Array("IBLOCK_ID"=>2);
    public function onPrepareComponentParams($arParams)
	{
        return $arParams;
    }
    public function executeComponent()
	{        
        $filter = array();
        $arParams = &$this->arParams;
        $arResult = &$this->arResult;
        $arResult = [
            'ITEMS' => []
        ];

        switch ($arParams['FILTER']) {
            case 'commercial':
                $filter['=COMMERCIAL'] = true;
                break;
            case 'less_than_5_years':
                $filter['>=DATE_PRODUCTION'] = date('Y-m-d', strtotime('-5 years'));
                break;
            default:
                break;
        }

        foreach ($arParams as $key => $value) {
            if (strpos($key, 'color_') === 0 && $value == 'Y') {
                $filter['=COLOR_ID'] = (int)str_replace('color_', '', $key);
                break;
            }
        }

        if (!empty($filter)) {
            $arResult['ITEMS'] = CarTable::getList(array(
                'select' => array('ID', 'BRAND', 'MODEL', 'DATE_PRODUCTION', 'PAYLOAD', 'COMMERCIAL', 'COLOR.NAME' => 'COLOR.NAME'),
                'filter' => $filter,
                'order' => array('ID' => 'ASC'),
            ))->fetchAll();
        } else {
            $arResult['ITEMS'] = CarTable::getList(array(
                'select' => array('ID', 'BRAND', 'MODEL', 'DATE_PRODUCTION', 'PAYLOAD', 'COMMERCIAL', 'COLOR.NAME' => 'COLOR.NAME'),
                'order' => array('ID' => 'ASC'),
            ))->fetchAll();
        }

        
        
        Loader::includeModule('iblock');
        $dbItems = CIBlockElement::GetList(
            [],
            [
                'IBLOCK_CODE' =>$arParams['IBLOCK_CODE'],
                'ACTIVE' => 'Y'
            ],
            [
                'IBLOCK_ID',
                'ID',
                'NAME',
                'BRAND',
                'MODEL', 
                'DATE_PRODUCTION', 
                'PAYLOAD', 
                'COMMERCIAL', 
                'COLOR.NAME' => 'COLOR.NAME'
            ]
        );
        $arResult =[];
        while ($arItem = $dbItems->Fetch()) {
          $arResult[] = $arItem;
        }

        $this->IncludeComponentTemplate();
    }
}

<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

class CarsList extends CBitrixComponent
{
    public $IBLOCK_ID = Array("IBLOCK_ID"=>2);
    public function onPrepareComponentParams($arParams)
	{
        return $arParams;
    }
    public function executeComponent()
	{        
        $arParams = &$this->arParams;
        $arResult = &$this->arResult;
        $arResult = [
            'ITEMS' => []
        ];
        
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

<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

class ElementList extends CBitrixComponent
{
    public $IBLOCK_ID = 2;
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
                'ACTIVE_TO'
            ]
        );
        $arResult =[];
        while ($arItem = $dbItems->Fetch()) {
          $arResult[] = $arItem;
        }

        $this->IncludeComponentTemplate();
    }
}

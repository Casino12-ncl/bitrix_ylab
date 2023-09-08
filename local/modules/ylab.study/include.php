<?
/** @global CMain $APPLICATION */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?><?

use Bitrix\Main\EventManager;
$eventManager = EventManager::getInstance();
$eventManager->addEventHandlerCompatible("main", "OnBeforeIBlockElementAdd", function(&$arFields) {
  $arFilter = Array("IBLOCK_ID"=>2);
  $db_list = CIBlockSection::GetCount($arFilter);                        
  if (strlen($arFields["NAME"]) > 0 && strlen($arFields["CODE"]) <= 0 && $db_list != '') {
    $length = strlen(trim($arFields['NAME']));
    {
      $arr = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
      );
    
      $res = '';
      for ($i = 0; $i < $length-1; $i++) {
        $res .= $arr[random_int(0, count($arr) - 1)];
        var_dump($res);
      }
      $arFields['CODE'] = $res;
    }

  }
    AddEventHandler("iblock", "OnBeforeIBlockElementAdd", 'Translit');
    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", 'Translit');
});
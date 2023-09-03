<?php 
/** @global CDatabase $DB */

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;

function Translit(&$arFields)
{
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
}
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", 'Translit');
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", 'Translit');

function deletePeople()
{
  Loader::includeModule('iblock');  

  $IBLOCK_ID = Array("IBLOCK_ID"=>2);
  $time = new DateTime(date("d.m.Y H:i:s"));
  $arFilter = array(
    "IBLOCK_ID" => $IBLOCK_ID,
    "ACTIVE" => "Y",
    '<DATE_ACTIVE_TO' => $time->format("d.m.Y H:i:s")
);
  $res = CIBlockElement::GetList(
      array("ID" => "ASC"),
      array("IBLOCK_ID" => $IBLOCK_ID),
      $arFilter,
      false,
      [
          'IBLOCK_ID',
          'ID',
          'NAME',
          'ACTIVE_TO',
          'DATE_ACTIVE_TO'
      ]
  );

  while ($arItem = $res->Fetch()) {

    $TIMESTAMP = $arItem["ACTIVE_TO"];
    $ELEMENT_ID = $arItem['ID'];           
    if (CIBlock::GetPermission($IBLOCK_ID) >= 'W') {
      $DB->StartTransaction();
      if (!CIBlockElement::Delete($ELEMENT_ID)) {       
          $element = (int)$ELEMENT_ID;                                            
          CIBlockElement::Delete($element);      
        $strWarning .= 'Error!';
        $DB->Rollback();
    } else {
        $DB->Commit();
    }
     
    }
  } 
  return "deletePeople();";
}





<?php 
/** @global CDatabase $DB */

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
function slugTranslit(&$arFields) {
 
  if (strlen($arFields["NAME"]) > 0 && strlen($arFields["CODE"]) <= 0) {
    $arParams = array(
      "max_len" => "100", 
      "change_case" => "L", 
      "replace_space" => "-", 
      "replace_other" => "-", 
      "delete_repeat_replace" => "true",
      "use_google" => "false",
    );
    $arFields["CODE"] = Cutil::translit($arFields["NAME"], "ru", $arParams);
  }
}
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", 'slugTranslit');
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", 'slugTranslit');

function deletePeople()
{
  Loader::includeModule('iblock');  

  $IBLOCK_ID = 2;
  $time = new DateTime(date("d.m.Y H:i:s"));

  $res = CIBlockElement::GetList(
      array("ID" => "ASC"),
      array("IBLOCK_ID" => $IBLOCK_ID),
      false,
      false,
      [
          'IBLOCK_ID',
          'ID',
          'NAME',
          'ACTIVE_TO'
      ]
  );

  while ($arItem = $res->Fetch()) {

    $TIMESTAMP = $arItem["ACTIVE_TO"];
    $ELEMENT_ID = $arItem['ID'];           
    if (CIBlock::GetPermission($IBLOCK_ID) >= 'W') {
      $DB->StartTransaction();
      if ($time->getTimestamp() > MakeTimeStamp($TIMESTAMP)) { 
                    $element = (int)$ELEMENT_ID;                                            
        CIBlockElement::Delete($element);
      }
    }
  } 
  return "deletePeople();";
}





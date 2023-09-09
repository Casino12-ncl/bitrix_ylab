<?
/** @global CDatabase $DB */

namespace Ylab\Study\Helper;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
class MyClass
{   

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
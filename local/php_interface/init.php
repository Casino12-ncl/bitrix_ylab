<?php 
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

function deletePeople($time){
  
  
  $time = date('d.m.Y H:i:s'); 
  $time = strtotime($time);
  $res = CIBlock::GetList(
    Array(), 
    Array(
      'ACTIVE'=>'Y',       
    ), true
  );
  while($ar_res = $res->Fetch())
  {
    echo $ar_res['NAME'].': '.$ar_res['ELEMENT_CNT'];
  }
  
  // foreach($arResult as $arSection) {    
  //   $peopleTime = strtotime($arSection['ACTIVE_TO']);
  //   if($time > $peopleTime) {
  //     CIBlockElement::Delete($arSection["ID"]);
  //   }
  // }
 return __METHOD__ . '();';
}




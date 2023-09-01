<?php 
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

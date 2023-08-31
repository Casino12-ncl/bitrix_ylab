<?php 
function slugTranslit(&$arFields) {
  // Если заполнено имя и не заполнен символьный код
  if (strlen($arFields["NAME"]) > 0 && strlen($arFields["CODE"]) <= 0) {
    $arParams = array(
      "max_len" => "100", // обрезаем символьный код до 100 символов
      "change_case" => "L", // приводим к нижнему регистру
      "replace_space" => "-", // меняем пробелы на тире
      "replace_other" => "-", // меняем плохие символы на тире
      "delete_repeat_replace" => "true", // удаляем повторяющиеся тире
      "use_google" => "false", // отключаем использование google
    );
    $arFields["CODE"] = Cutil::translit($arFields["NAME"], "ru", $arParams);
  }
}
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", 'slugTranslit');
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", 'slugTranslit');
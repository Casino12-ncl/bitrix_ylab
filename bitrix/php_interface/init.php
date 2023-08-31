<?php 
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "addElement");

function addElement($arFields){

      $arParams = array(
               "max_len" => "60", // обрезаем символьный код до 60 символов
               "change_case" => "L", // приводим к нижнему регистру
               "replace_space" => "-", // меняем пробелы на тире
               "replace_other" => "-", // меняем плохие символы на тире
               "delete_repeat_replace" => "true", // удаляем повторяющиеся тире
               "use_google" => "false", // отключаем использование google
            );

      $arFields["CODE"] = Cutil::translit($arFields["NAME"], "ru", $arParams);

}
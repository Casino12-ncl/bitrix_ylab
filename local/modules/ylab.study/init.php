<?php


use Bitrix\Main\Loader;
/** @global CDatabase $DB */
Loader::requireModule('ylab.study');
RegisterModule("ylab.study");
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", 'Translit');



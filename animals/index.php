<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule("highloadblock");
$APPLICATION->SetTitle("Животные");
$APPLICATION->IncludeComponent(
    "ylab:animals.list", ".default",    
    array(
        "HLBLOCK_ID" => "3",
    )
);
?>

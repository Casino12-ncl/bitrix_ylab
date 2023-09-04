<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Закрытый доступ");

$APPLICATION->IncludeComponent("ylab:elements.list", ".default", array(
	"COMPONENT_TEMPLATE" =>".default",
	"IBLOCK_CODE" => "private_access",		
	),
	false
);?>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
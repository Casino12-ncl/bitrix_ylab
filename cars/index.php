<?
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("cars");

Loader::requireModule('ylab.study');
$APPLICATION->IncludeComponent("ylab:cars.list", "", array(
	"COMPONENT_TEMPLATE" =>".default",	
	),
);

?>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
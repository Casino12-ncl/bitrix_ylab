<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="news-list">
<?if (empty($arResult['ITEMS'])) {
    return;
}
?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?$rsSections = CIBlockSection::GetList(
    Array("SORT" => "ASC"),
    Array(
        "=IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "=ACTIVE"    => "Y"
    )
);

while ($arSection = $rsSections->GetNext())
    $arSections[] = $arSection;

foreach ($arSections as $arSection){
    foreach ($arResult["ITEMS"] as $arItem){
        if ($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"])
            $arSection["ELEMENTS"][] = $arItem;
    }
    $arElementGroups[] = $arSection;
}

$arResult["ITEMS"] = $arElementGroups;

foreach ($arResult["ITEMS"] as $arSection):?>
    <h4><?=$arSection["NAME"]?></h4>
    <?if ($arSection["ELEMENTS"]):?>
        <ul>
            <?foreach ($arSection["ELEMENTS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                    <span><?=$arItem['PROPERTIES']['WEIGHT']['VALUE']?></span>
                    <span><?=$arItem['PROPERTIES']['COUNT']['VALUE']?></span>
                </li>
            <?endforeach?>
        </ul>
    <?endif?>
<?endforeach?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

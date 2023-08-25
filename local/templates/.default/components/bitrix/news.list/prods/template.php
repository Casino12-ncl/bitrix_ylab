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

<?$arFilter = array('IBLOCK_ID' => 1); 


$rsSect = CIBlockSection::GetList(
     Array("SORT"=>"ASC"),
     $arSelect 
);



while ($arSect = $rsSect->GetNext()) {   
    
     
    echo $arSect['NAME'];
      
    foreach($arResult["ITEMS"] as $arItem):?>    
    
        <div id="<?=$this->GetEditAreaId($arItem['ID'])?>">
            <a href="<?=$arItem['$DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
            
            <span><?=$arItem['PROPERTIES']['WEIGHT']['VALUE']?></span>
            <span><?=$arItem['PROPERTIES']['COUNT']['VALUE']?></span>
            
        </div>
    
    <?endforeach;
    
}?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

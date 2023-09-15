<?php

/** BitrixVars
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\UI\Buttons\Button;
use Bitrix\UI\Buttons\Color;
use Bitrix\UI\Buttons\Icon;

$this->setFrameMode(true);

$listId = $arResult['LIST_ID'];
$gridId = $arResult['GRID_ID'];
$columns = $arResult['COLUMNS'];
$rows = $arResult['ROWS'];
$navObject = $arResult['NAV_OBJECT'];
$totalRowsCount = $arResult['TOTAL_ROWS_COUNT'];
$pageSizes = $arResult['PAGE_SIZES'];
$actionPanel = $arResult['ACTION_PANEL'];

$filterParams = $arResult['FILTER_PARAMS'];
?>

<div class="wrapper">
    
    <?php

    $arFilterComponentParams = [
        'GRID_ID' => $gridId,
        'FILTER_ID' => $listId,
        'FILTER' => $filterParams,
        'ENABLE_LIVE_SEARCH' => false,
        'DISABLE_SEARCH' => true,
        'ENABLE_LABEL' => true,
    ];

    $APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', $arFilterComponentParams);

    $APPLICATION->IncludeComponent(
        'bitrix:main.ui.grid',
        '',
        [
            'AJAX_ID' => CAjax::getComponentID('bitrix:main.ui.grid', '.default', $listId),
            'AJAX_MODE' => 'Y',
            'AJAX_OPTION_HISTORY' => 'N',
            'AJAX_OPTION_JUMP' => 'N',
            'AJAX_OPTION_SHADOW' => 'N',
            'AJAX_OPTION_STYLE' => 'N',
            'AJAX_OPTION_ADDITIONAL' => $listId,
            'GRID_ID' => $gridId,
            'ACTION_PANEL' => $actionPanel,
            'COLUMNS' => $columns,
            'ROWS' => $rows,
            'NAV_OBJECT' => $navObject,
            'TOTAL_ROWS_COUNT' => $totalRowsCount,
            'PAGE_SIZES' =>  $pageSizes,
            'ALLOW_COLUMNS_RESIZE'      => $arParams['ALLOW_COLUMNS_RESIZE'],
            'ALLOW_COLUMNS_SORT'        => $arParams['ALLOW_COLUMNS_SORT'],
            'ALLOW_HORIZONTAL_SCROLL'   => $arParams['ALLOW_HORIZONTAL_SCROLL'],
            'ALLOW_PIN_HEADER'          => $arParams['ALLOW_PIN_HEADER'],
            'ALLOW_SORT'                => $arParams['ALLOW_SORT'],
            'SHOW_ACTION_PANEL'         => $arParams['SHOW_ACTION_PANEL'],
            'SHOW_ROW_CHECKBOXES'       => $arParams['SHOW_ROW_CHECKBOXES'],
            'SHOW_CHECK_ALL_CHECKBOXES' => $arParams['SHOW_CHECK_ALL_CHECKBOXES'],
            'SHOW_GRID_SETTINGS_MENU'   => $arParams['SHOW_GRID_SETTINGS_MENU'],
            'SHOW_NAVIGATION_PANEL'     => $arParams['SHOW_NAVIGATION_PANEL'],
            'SHOW_PAGESIZE'             => $arParams['SHOW_PAGESIZE'],
            'SHOW_PAGINATION'           => $arParams['SHOW_PAGINATION'],
            'SHOW_ROW_ACTIONS_MENU'     => $arParams['SHOW_ROW_ACTIONS_MENU'],
            'SHOW_SELECTED_COUNTER'     => $arParams['SHOW_SELECTED_COUNTER'],
            'SHOW_TOTAL_COUNTER'        => $arParams['SHOW_TOTAL_COUNTER'],
        ]
    );
    
   ?> 
</div>

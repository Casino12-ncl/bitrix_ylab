<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Ylab\Study\Entity\CarTable;

$filter = array();

switch ($arParams['FILTER']) {
    case 'commercial':
        $filter['=COMMERCIAL'] = true;
        break;
    case 'less_than_5_years':
        $filter['>=DATE_PRODUCTION'] = date('Y-m-d', strtotime('-5 years'));
        break;
    default:
        break;
}

foreach ($arParams as $key => $value) {
    if (strpos($key, 'color_') === 0 && $value == 'Y') {
        $filter['=COLOR_ID'] = (int)str_replace('color_', '', $key);
        break;
    }
}

if (!empty($filter)) {
    $arResult['ITEMS'] = CarTable::getList(array(
        'select' => array('ID', 'BRAND', 'MODEL', 'DATE_PRODUCTION', 'PAYLOAD', 'COMMERCIAL', 'COLOR.NAME' => 'COLOR.NAME'),
        'filter' => $filter,
        'order' => array('ID' => 'ASC'),
    ))->fetchAll();
} else {
    $arResult['ITEMS'] = CarTable::getList(array(
        'select' => array('ID', 'BRAND', 'MODEL', 'DATE_PRODUCTION', 'PAYLOAD', 'COMMERCIAL', 'COLOR.NAME' => 'COLOR.NAME'),
        'order' => array('ID' => 'ASC'),
    ))->fetchAll();
}

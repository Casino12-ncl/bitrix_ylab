<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;

if (!Loader::includeModule('ylab.study')) {
    return;
}

$arComponentParameters = array(
    'GROUPS' => array(),
    'PARAMETERS' => array(
        'FILTER' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Фильтр для автомобилей',
            'TYPE' => 'LIST',
            'VALUES' => array(
                'all' => 'Все автомобили',
                'commercial' => 'Коммерческие автомобили',
                'less_than_5_years' => 'Автомобили моложе 5 лет',                
            ),
        ),
        'CACHE_TIME' => array(
            'DEFAULT' => 3600,
        ),
    ),
);

$colors = \Ylab\Study\Entity\ColorTable::getList(array(
    'select' => array('ID', 'NAME'),
));

$arFilterValues = array();
foreach ($colors as $color) {
    $arFilterValues['color_' . $color['ID']] = $color['NAME'];
}

$arComponentParameters['PARAMETERS']['FILTER']['VALUES'] += $arFilterValues;

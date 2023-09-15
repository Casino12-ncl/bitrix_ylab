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



$dataClass = DataManager::getTableName($tableName);
$result = $dataClass::getList(array(
    'select' => array('*'), 
    'order' => array('ID' => 'ASC')
));

?>
<table>
  <thead>
    <tr>
      <?php foreach ($result->getFields() as $field): ?>
        <th><?= $field->getTitle() ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch()): ?>
      <tr>
        <?php foreach ($row as $fieldValue): ?>
          <td><?= $fieldValue ?></td>
        <?php endforeach; ?>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

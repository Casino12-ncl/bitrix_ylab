<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
IncludeModuleLangFile(__FILE__);
$this->setFrameMode(true);

/** @var array $arResult */
?>
<div class="cars-list">
    <div class="filter">
        <form method="get" action="<?= $APPLICATION->GetCurPage() ?>">
            <input type="hidden" name="filter" value="<?= $arParams['FILTER'] ?>">
            <label>Список доступных цветов:</label>
            <?php foreach ($arResult['FILTER_VALUES'] as $key => $value): ?>
                <label>
                    <input type="checkbox" name="<?= $key ?>" <?= ($arParams[$key] == 'Y') ? 'checked' : '' ?>> <?= $value ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Применить</button>
        </form>
    </div>
    <?php if (empty($arResult['ITEMS'])): ?>
        <p>Ничего не найдено.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($arResult['ITEMS'] as $item): ?>
                <li>
                    <div><?= $item['BRAND'] ?> <?= $item['MODEL'] ?></div>
                    <div>Дата производства: <?= $item['DATE_PRODUCTION'] ?></div>
                    <div>Грузоподъёмность: <?= $item['PAYLOAD'] ?></div>
                    <div>Цвет: <?= $item['COLOR_NAME'] ?></div>
                    <?php if ($item['COMMERCIAL']): ?>
                        <div>Коммерческий транспорт: да</div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

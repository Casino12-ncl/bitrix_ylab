<?php
/**@global CMain $APPLICATION */

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class AnimalsList extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable, \Bitrix\Main\Errorable
{
    protected static $componentCounter = 0;

    /** @var ErrorCollection */
    protected $errorCollection;
    public function configureActions()
    {
        //если действия не нужно конфигурировать, то пишем просто так. И будет конфиг по умолчанию
        return [];
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();

        //подготовка параметров
        //Этот код **будет** выполняться при запуске аяксовых-действий
    }

    // public function getTimeAction($format)
    // {
    //     return date($format);
    // }

    /**
     * Getting array of errors.
     * @return \Bitrix\Main\Error[]
     */
    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }
    /**
     * Getting once error with the necessary code.
     * @param string $code Code of error.
     * @return \Bitrix\Main\Error
     */
    public function getErrorByCode($code)
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    public function executeComponent()
    {
        $arResult = &$this->arResult;

        self::$componentCounter++;

        Loader::requireModule('highloadblock');

        $arResult = [
            'COLUMNS' => [
                [
                    'id' => 'ID',
                    'name' => 'ID',
                    'sort' => 'ID',
                    'default' => true
                ],
                // [
                //     'id' => 'UF_CAR_BRAND',
                //     'name' => 'Марка',
                //     'sort' => 'UF_CAR_BRAND',
                //     'default' => true
                // ],
                // [
                //     'id' => 'UF_CAR_MODEL',
                //     'name' => 'Модель',
                //     'sort' => 'UF_CAR_MODEL',
                //     'default' => true
                // ],
                // [
                //     'id' => 'UF_PRODUCTION_DATE',
                //     'name' => 'Дата производства',
                //     'sort' => 'UF_PRODUCTION_DATE',
                //     'default' => true
                // ],
                // [
                //     'id' => 'UF_LOAD_CAPACITY',
                //     'name' => 'Грузоподъемность',
                //     'sort' => 'UF_LOAD_CAPACITY',
                //     'default' => true
                // ],
                // [
                //     'id' => 'UF_IS_COMMERCIAL',
                //     'name' => 'Коммерческий',
                //     'sort' => 'UF_IS_COMMERCIAL',
                //     'default' => true
                // ],
                // [
                //     'id' => 'UF_COLOR',
                //     'name' => 'Цвет',
                //     'sort' => 'UF_COLOR',
                //     'default' => true
                // ],
            ],
            // 'LIST_ID' => 'cars_grid_list_' . self::$componentCounter,
            // 'GRID_ID' => 'cars_grid_' . self::$componentCounter,
            // 'NAV_ID' => 'cars_grid_nav_' . self::$componentCounter,
            // 'ROWS' => [],
            // 'NAV_OBJECT' => null,
            // 'PAGE_SIZES' => [
            //     ['NAME' => '10', 'VALUE' => '10'],
            //     ['NAME' => '20', 'VALUE' => '20'],
            //     ['NAME' => '50', 'VALUE' => '50'],
            // ],
            // 'ACTION_PANEL' => null,
            // 'FILTER_PARAMS' => [
            //     ['id' => 'NAME', 'name' => 'Название', 'type' => 'text', 'default' => true],
            //     ['id' => 'DATE_CREATE', 'name' => 'Дата создания', 'type' => 'date', 'default' => true],
            // ],
        ];

        $navParams = (new GridOptions($arResult['GRID_ID']))->GetNavParams();
        $arResult['NAV_OBJECT'] = new PageNavigation($arResult['NAV_ID']);
        $arResult['NAV_OBJECT']->allowAllRecords(true)
            ->setPageSize($navParams['nPageSize'])
            ->initFromUri();

        $entityClass = HighloadBlockTable::compileEntity('Animal')->getDataClass();
        $query = $entityClass::query()
            ->setSelect(['*'])
            ->countTotal(true);
        if ($arResult['NAV_OBJECT']) {
            $query->setOffset($arResult['NAV_OBJECT']->getOffset());
            $query->setLimit($arResult['NAV_OBJECT']->getLimit());
        }
        $result = $query->exec();
        $arResult['TOTAL_ROWS_COUNT'] = $result->getCount();
        $arResult['NAV_OBJECT']->setRecordCount($arResult['TOTAL_ROWS_COUNT']);

        while ($item = $result->fetch()) {
            // тут можно модифицировать какие-либо поля перед присвоением в массив

            $arResult['ROWS'][] = [
                'data' => $item,
                'actions' => [],
                'attrs' => [],
            ];
        }

        $this->includeComponentTemplate();
    }
}
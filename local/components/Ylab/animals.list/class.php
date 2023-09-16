<?php
/**@global CMain $APPLICATION */
use Bitrix\Main\Error;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;


if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
global $class1, $class2;
class AnimalsList extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable, \Bitrix\Main\Errorable
{
    protected static $componentCounter = 0;

    /** @var ErrorCollection */
    protected $errorCollection;
    public function configureActions()
{
    return [];
}
const HL_ENTITY = 'Animal';
    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();

        //подготовка параметров
        //Этот код **будет** выполняться при запуске аяксовых-действий
    }

    public function deleteItemsAction(int $id)
    {
        Loader::IncludeModule("highloadblock");

        $entity = HighloadBlockTable::compileEntity(self::HL_ENTITY)->getDataClass();            
        $entity::Delete($id);
        
    }   
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
                [
                    'id' => 'UF_TYPE',
                    'name' => 'Вид животного',
                    'sort' => 'UF_TYPE',
                    'default' => true
                ],
                [
                    'id' => 'UF_GENDER',
                    'name' => 'Пол',
                    'sort' => 'UF_GENDER',
                    'default' => true
                ],
                [
                    'id' => 'UF_KLICHKA',
                    'name' => 'Кличка',
                    'sort' => 'UF_KLICHKA',
                    'default' => true
                ],                
                [
                    'id' => 'UF_DATE',
                    'name' => 'Дата',
                    'sort' => 'UF_DATE',
                    'default' => true
                ],
                [
                    'id' => 'UF_PLACE',
                    'name' => 'место рождения',
                    'sort' => 'UF_PLACE',
                    'default' => true
                ],                
            ],
            'LIST_ID' => 'animal_grid_list_' . self::$componentCounter,
            'GRID_ID' => 'animal_grid_' . self::$componentCounter,
            'NAV_ID' => 'animal_grid_nav_' . self::$componentCounter,
            'ROWS' => [],
            'NAV_OBJECT' => null,
            'PAGE_SIZES' => [
                ['NAME' => '2', 'VALUE' => '2'],
                ['NAME' => '3', 'VALUE' => '3'],
                ['NAME' => '5', 'VALUE' => '5'],
            ],
            'ACTION_PANEL' => null,
            'FILTER_PARAMS' => [
                ['id' => 'NAME', 'name' => 'Название', 'type' => 'text', 'default' => true],
                ['id' => 'DATE', 'name' => 'Дата', 'type' => 'date', 'default' => true],
            ],
        ];

        $navParams = (new GridOptions($arResult['GRID_ID']))->GetNavParams();
        $arResult['NAV_OBJECT'] = new PageNavigation($arResult['NAV_ID']);
        $arResult['NAV_OBJECT']->allowAllRecords(true)
            ->setPageSize($navParams['nPageSize'])
            ->initFromUri();
        $entityClass = HighloadBlockTable::compileEntity('Animal')->getDataClass();
        $arSelect = [
            '*',
            'UF_NAME_TYPE' => 'UF_TYPE_REF.UF_NAME',
            'UF_GENDER_NAME' => 'UF_GENDER_REF.UF_NAME'
        ];        
        $query = $entityClass::query()
            ->setSelect($arSelect)
            ->countTotal(true);
        if ($arResult['NAV_OBJECT']) {
            $query->setOffset($arResult['NAV_OBJECT']->getOffset());
            $query->setLimit($arResult['NAV_OBJECT']->getLimit());
        }
        $result = $query->exec();
        $arResult['TOTAL_ROWS_COUNT'] = $result->getCount();
        $arResult['NAV_OBJECT']->setRecordCount($arResult['TOTAL_ROWS_COUNT']);
        
        while ($item = $result->fetch()) {
            $item['UF_GENDER'] = $item['UF_GENDER_NAME'];
            $item['UF_TYPE'] = $item['UF_NAME_TYPE'];
            $arResult['ROWS'][] = [
                'data' => $item,
                'actions' => [[
                        'text' => 'Удалить из справочника',
                        "onclick" => "BX.ajax.runComponentAction('ylab:animals.list', 'deleteItems',{
                                mode:'class',
                                data: { id: ".$item['ID'].",},
                            }).then(function (response) {
                                console.log('success');
                                console.log(response);
                                location.reload();
                            },function (response) {
                              console.log('error');
                              console.log(response);
                            });
                        "],
                        ],   
                'attrs' => [],
            ];   
        }
        $this->includeComponentTemplate();
    }
}
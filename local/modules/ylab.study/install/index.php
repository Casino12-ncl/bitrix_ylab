<?php
use Ylab\Study\Entity\CarTable;
use Ylab\Study\Entity\ColorTable;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
Loader::registerNamespace("Ylab\\Study\\Entity", dirname(__DIR__) . '/lib/Entity');
IncludeModuleLangFile(__FILE__);
Class ylab_study extends CModule
{
    public $MODULE_ID = "ylab.study";
    public $MODULE_NAME;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;  

    function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__ . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_ID = 'ylab.study';
        $this->MODULE_NAME = GetMessage('MY_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('MY_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = GetMessage('MY_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('MY_PARTNER_URI');
    }

    function DoInstall()
    {
        Loader::includeModule("iblock");
        
        $this->InstallFiles();
        $this->InstallEvents();
        $this->InstallDB();

        RegisterModule($this->MODULE_ID);

        return true;
    }
    function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        $this->UnInstallDB();

        UnRegisterModule($this->MODULE_ID);       
    }
    
    public function InstallFiles()
    {
        CopyDirFiles(__DIR__ . '/bitrix/components/', getenv('DOCUMENT_ROOT') . '/bitrix/components/', true, true);

        return true;
    }
    public function UnInstallFiles()
    {
        DeleteDirFilesEx('/bitrix/components/Ylab');
        

        return true;
    }
    function InstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->registerEventHandlerCompatible('main', 'OnBeforeProlog', $this->MODULE_ID);        
        $eventManager->addEventHandlerCompatible("main", "OnBeforeProlog", function(&$arFields) {
        $arFilter = Array("IBLOCK_ID"=>2);
        $db_list = CIBlockSection::GetCount($arFilter);                        
        if (strlen($arFields["NAME"]) > 0 && strlen($arFields["CODE"]) <= 0 && $db_list != '') {
            $length = strlen(trim($arFields['NAME']));
            {
            $arr = array(
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
                'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            );
            
            $res = '';
            for ($i = 0; $i < $length-1; $i++) {
                $res .= $arr[random_int(0, count($arr) - 1)];
                var_dump($res);
            }
            $arFields['CODE'] = $res;
            }

        }
            AddEventHandler("iblock", "OnBeforeIBlockElementAdd", 'Translit');
            AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", 'Translit');
        });
        
    }
    function UnInstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->unRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
    }
    
    public function InstallDB()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if (!$connection->isTableExists(CarTable::getTableName())) {
            CarTable::getEntity()->createDbTable();
        }
        if (!$connection->isTableExists(ColorTable::getTableName())) {
            ColorTable::getEntity()->createDbTable();
        }
    }

    public function UnInstallDB()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        $name = CarTable::getTableName();
        if ($connection->isTableExists($name)) {
            $connection->dropTable($name);
        }
        $name = ColorTable::getTableName();
        if ($connection->isTableExists($name)) {
            $connection->dropTable($name);
        }
    }
}


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
        
        AddEventHandler("iblock", "OnBeforeIBlockElementAdd", ['\Ylab\Study\Helper\AccessCode', 'translit']);
        AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ['\Ylab\Study\Helper\AccessCode', 'translit']);
       
        
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


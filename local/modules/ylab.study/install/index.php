<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
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

        RegisterModule($this->MODULE_ID);

        return true;
    }
    function DoUninstall()
    {
        $this->UninstallFiles();
        UnRegisterModule($this->MODULE_ID);       
    }
    
    public function InstallFiles()
    {
        CopyDirFiles(__DIR__ . '/bitrix/components/', getenv('DOCUMENT_ROOT') . '/bitrix/components/', true, true);

        return true;
    }
    public function UninstallFiles()
    {
        DeleteDirFilesEx("/bitrix/components/{$this->MODULE_ID}");

        return true;
    }

}

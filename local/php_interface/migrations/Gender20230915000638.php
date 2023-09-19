<?php

namespace Sprint\Migration;
use Bitrix\Highloadblock\HighloadBlockTable;


class Gender20230915000638 extends Version
{
    protected $description = "Пол животных";

    protected $moduleVersion = "4.3.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
    $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Gender',
  'TABLE_NAME' => 'animal_gender',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Пол',
    ),
    'en' => 
    array (
      'NAME' => 'Gender',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_ID',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'ID',
    'ru' => 'ID',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'ID',
    'ru' => 'ID',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'ID',
    'ru' => 'ID',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_CODE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'CODE',
    'ru' => 'CODE',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'CODE',
    'ru' => 'CODE',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'CODE',
    'ru' => 'CODE',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Gender',
    'ru' => 'Пол',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Gender',
    'ru' => 'Пол',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Gender',
    'ru' => 'Пол',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
        }

        public function down()
        {
            $hlBlockName = 'Gender';        
            
            $hlBlock = null;
            if (!empty($hlBlockId)) {
                $hlBlock = HighloadBlockTable::getById($hlBlockId)->fetch();
            } elseif (!empty($hlBlockName)) {
                $hlBlock = HighloadBlockTable::getList([
                    'filter' => ['=NAME' => $hlBlockName]
                ])->fetch();
            }        
          if ($hlBlock && $hlBlock["ID"] > 0) {   
            HighloadBlockTable::delete($hlBlock["ID"]);
          }
        }
}

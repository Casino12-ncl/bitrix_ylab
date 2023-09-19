<?php

namespace Sprint\Migration;
use Bitrix\Highloadblock\HighloadBlockTable;

class animalsNames20230915000710 extends Version
{
    protected $description = "сами животные";

    protected $moduleVersion = "4.3.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
    $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Animal',
  'TABLE_NAME' => 'animal',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Животное',
    ),
    'en' => 
    array (
      'NAME' => 'Animal',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_TYPE',
  'USER_TYPE_ID' => 'hlblock',
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
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 1,
    'HLBLOCK_ID' => 'Animals',
    'HLFIELD_ID' => 'UF_NAME',
    'DEFAULT_VALUE' => 0,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Animal type',
    'ru' => 'Вид животного',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Animal type',
    'ru' => 'Вид животного',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Animal type',
    'ru' => 'Вид животного',
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
  'FIELD_NAME' => 'UF_KLICHKA',
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
    'en' => 'KLICHKA',
    'ru' => 'Кличка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'KLICHKA',
    'ru' => 'Кличка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'KLICHKA',
    'ru' => 'Кличка',
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
  'FIELD_NAME' => 'UF_GENDER',
  'USER_TYPE_ID' => 'hlblock',
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
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 1,
    'HLBLOCK_ID' => 'Gender',
    'HLFIELD_ID' => 'UF_NAME',
    'DEFAULT_VALUE' => 0,
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
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE',
  'USER_TYPE_ID' => 'date',
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
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Bithday',
    'ru' => 'Дата рождения',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Bithday',
    'ru' => 'Дата рождения',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Bithday',
    'ru' => 'Дата рождения',
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
  'FIELD_NAME' => 'UF_PLACE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
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
    'en' => 'PLACE',
    'ru' => 'Место',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'PLACE',
    'ru' => 'Место',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'PLACE',
    'ru' => 'Место',
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
      $hlBlockName = 'Animal';
      $hlBlock = null;
      if (!empty($hlBlockId)) {
          $hlBlock = HighloadBlockTable::getById($hlBlockId)->fetch();
      } elseif (!empty($hlBlockName)) {
          $hlBlock = HighloadBlockTable::getList([
              'filter' => ['=NAME' => $hlBlockName]
          ])->fetch();
      }        
      if ($hlBlock && $hlBlock["ID"] > 0)
      {
          HighloadBlockTable::delete($hlBlock["ID"]);
      }
  }
}

<?php

namespace Sprint\Migration;


class infoblock_categories20230829104929 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.3.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'prods',
            'prods'
        );

        $helper->Iblock()->addSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Ноутбуки',
    'CODE' => '',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'DESCRIPTION' => 'ноуты',
    'DESCRIPTION_TYPE' => 'text',
  ),
  1 => 
  array (
    'NAME' => 'компы',
    'CODE' => 'computers',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'DESCRIPTION' => 'компы',
    'DESCRIPTION_TYPE' => 'text',
  ),
  2 => 
  array (
    'NAME' => 'Мониторы',
    'CODE' => 'monitors',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'DESCRIPTION' => 'Мониторы',
    'DESCRIPTION_TYPE' => 'text',
  ),
)        );
    }

    public function down()
    {
      $helper = $this->getHelperManager();
      $ok = $helper->Iblock()->deleteIblockIfExists('prods');

      if ($ok) {
          $this->outSuccess('Инфоблок удален');
      } else {
          $this->outError('Ошибка удаления инфоблока');
      }
    }
}

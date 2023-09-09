<?
namespace Ylab\Study\Entity;


use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class ColorTable extends DataManager
{
   public static function getTableName()
   {
       return 'color';
   }

   public static function getMap()
   {
       return [
           new IntegerField('ID', [
               'primary' => true,
               'autocomplete' => true
           ]),
           new StringField('CODE', [
               'required' => true, 
            ]),
          new StringField('NAME', [
               'required' => true,
              
       ]),
        ];
   }
}

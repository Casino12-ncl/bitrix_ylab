<?
namespace Ylab\Study\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;



class CarTable extends DataManager
{
    public static function getTableName()
    {
        return 'car';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true
            ]),
            new StringField('BRAND', [
                'required' => true,               
            ]),
            new StringField('MODEL', [
                'required' => true,               
            ]),
            new DateField('DATE_PRODUCTION', [
                'required' => true,
            ]),
            new IntegerField('PAYLOAD'),
            new IntegerField('COLOR_ID'),
            new BooleanField('COMMERCIAL'),
            new \Bitrix\Main\ORM\Fields\Relations\Reference(
                'COLOR',
                'Ylab\Study\Entity\Color',
                ['=this.COLOR_ID' => 'ref.ID'],
                ['join_type' => 'LEFT']
            ),
        ];
    }
}

<? 
namespace ylab\study\Helper;

use CIBlock;

class Iblock
{
    public static function GetIdByCode($code)
    {
        $iblockId = false;
        $iblock = CIBlock::GetList([], ['CODE' => $code])->Fetch();
        if($iblock) {
            $iblockId = $iblock['ID'];
        }
        return $iblockId;
    }
}
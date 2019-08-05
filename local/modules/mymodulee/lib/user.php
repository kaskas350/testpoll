<?php
namespace Bitrix\Mymodulee;
use Bitrix\Main\Entity;

class UserTable extends Entity\DataManager {

    public function __construct()
    {
        echo 3456;
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField("ID",[
                "primary"=>true,
                "autocomplete"=>true,
            ]),
            new Entity\StringField("NAME",[]),
            new Entity\IntegerField("AGE",[])
        ];
    }

    public static function getTableName(){
        return "User";
    }


}

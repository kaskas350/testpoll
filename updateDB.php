<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");
?>
<?
if (CModule::IncludeModule("iblock")) {

    $typeIBlocks = CIBlockType::GetByID("test");
    $typeIBlock = $typeIBlocks->Fetch();
    $objCIBlockType = new CIBlockType;
    $objCIBlock = new CIBlock;
    $objCIBlockProperty = new CIBlockProperty;
    $objCIBlockElement = new CIBlockElement;
    /*
     *
     *
     * */
    if (empty($typeIBlock)) {
        //если не существует типа инфоблока
       echo 34;
        $arFields = [
            "ID" => "test",
            "LANG" =>[
               "ru"=>[ "IBLOCK_TYPE_ID"=>"test",
                "LID"=>"ru",
                "NAME"=>"Тест"
               ]
            ]
        ];
        $objCIBlockType->Add($arFields);
    }


     $iblocks = CIBlock::GetList([], [
        "CODE" => ["forma", "ROD_DEYATELNOSTI1"]
    ]);
    $arCode = [];

    while ($iblock = $iblocks->Fetch()) {
        if (!empty($iblock)) {
            $arCode[] = $iblock["CODE"];
        }
    }

    $idRodDeyat = 0;
    if (!in_array("ROD_DEYATELNOSTI1", $arCode)) {
        $arFields = [
            "LID" => "s1",
            "CODE" => "ROD_DEYATELNOSTI1",
            "IBLOCK_TYPE_ID"=>"test",
            "NAME"=>"Род деятельности"
        ];
        $idRodDeyat = $idBlock = $objCIBlock->Add($arFields);

        $arFields = [
            0=> [
                "CODE"=> "working",
                "NAME"=> "Рабочий",
                "IBLOCK_ID"=>$idBlock,
            ],
            1=> [
                "CODE"=> "employee",
                "NAME"=> "Служащий",
                "IBLOCK_ID"=>$idBlock,
            ],
            2=> [
                "CODE"=> "student",
                "NAME"=> "Студент",
                "IBLOCK_ID"=>$idBlock,
            ],
            3=> [
                "CODE"=> "head",
                "NAME"=> "Руководитель",
                "IBLOCK_ID"=>$idBlock,
            ],
            4=> [
                "CODE"=> "pensioner",
                "NAME"=> "Пенсионер",
                "IBLOCK_ID"=>$idBlock,
            ],
            5=> [
                "CODE"=> "housewife",
                "NAME"=> "Домохозяйка",
                "IBLOCK_ID"=>$idBlock,
            ],
            6=> [
                "CODE"=> "nothing",
                "NAME"=> "Ничем",
                "IBLOCK_ID"=>$idBlock,
            ],
            7=> [
                "CODE"=> "other",
                "NAME"=> "Другое",
                "IBLOCK_ID"=>$idBlock,
            ],
        ];
        foreach ($arFields as $fields) {
            $objCIBlockElement->Add($fields);
        }
    }


    if (!in_array("forma", $arCode)) {
        $arFields = [
            "LID" => "s1",
            "CODE" => "forma",
            "IBLOCK_TYPE_ID"=>"test",
            "NAME"=>"Форма"
        ];
        $idBlock = $objCIBlock->Add($arFields);
        $arIdProperty=[];
       $arPropertyFields = [
           0=> [
               "IBLOCK_ID"=>$idBlock,
               "CODE"=> "IMYA",
               "NAME"=> "Имя",
               "PROPERTY_TYPE"=> "S",
               "MULTIPLE"=>"N"
           ],
           1=> [
               "IBLOCK_ID"=>$idBlock,
               "CODE"=> "FAMILIYA",
               "NAME"=> "Фамилия",
               "PROPERTY_TYPE"=> "S",
               "MULTIPLE"=>"N"
           ],
           2=> [
               "IBLOCK_ID"=>$idBlock,
               "CODE"=> "POL",
               "NAME"=> "Пол",
               "PROPERTY_TYPE"=> "L",
               "MULTIPLE"=>"N"
           ],
           3=> [
               "IBLOCK_ID"=>$idBlock,
               "CODE"=> "ROD_DEYATELNOSTI",
               "NAME"=> "Род Деятельности",
               "LINK_IBLOCK_ID" => $idRodDeyat,
               "PROPERTY_TYPE"=> "E",
               "MULTIPLE"=>"N"
           ],
           4=> [
               "IBLOCK_ID"=>$idBlock,
               "CODE"=> "AGE",
               "NAME"=> "Возраст",
               "PROPERTY_TYPE"=> "L",
               "MULTIPLE"=>"Y"
           ],
           5=> [
               "IBLOCK_ID"=>$idBlock,
               "CODE"=> "ID",
               "NAME"=> "ID",
               "PROPERTY_TYPE"=> "S",
               "MULTIPLE"=>"N"
           ],
       ];

       foreach ($arPropertyFields as $arFields) {
           $arIdProperty[$arFields["CODE"]] = $objCIBlockProperty->Add($arFields);
       }

       $arEnums = [
           0=>[
               "PROPERTY_ID"=>$arIdProperty["POL"],
               "VALUE"=>"Мужской",
               "XML_ID"=>"man",
               "EXTERNAL_ID"=>"man",
               "PROPERTY_NAME" =>"Пол",
               "PROPERTY_CODE"=>"POL"
           ],
           1=>[
               "PROPERTY_ID"=>$arIdProperty["POL"],
               "VALUE"=>"Женский",
               "XML_ID"=>"woman",
               "EXTERNAL_ID"=>"woman",
               "PROPERTY_NAME" =>"Пол",
               "PROPERTY_CODE"=>"POL"
           ],

           3=>[
               "PROPERTY_ID"=>$arIdProperty["AGE"],
               "VALUE"=>"до 18",
               "XML_ID"=>"do_18",
               "EXTERNAL_ID"=>"do_18",
               "PROPERTY_NAME" =>"Возраст",
               "PROPERTY_CODE"=>"AGE"
           ],
           4=>[
               "PROPERTY_ID"=>$arIdProperty["AGE"],
               "VALUE"=>"от 18 до 25",
               "XML_ID"=>"ot_18_do_25",
               "EXTERNAL_ID"=>"ot_18_do_25",
               "PROPERTY_NAME" =>"Возраст",
               "PROPERTY_CODE"=>"AGE"
           ],
           5=>[
               "PROPERTY_ID"=>$arIdProperty["AGE"],
               "VALUE"=>"больше 25",
               "XML_ID"=>"bolshe_25",
               "EXTERNAL_ID"=>"bolshe_25",
               "PROPERTY_NAME" =>"Возраст",
               "PROPERTY_CODE"=>"AGE"
               ]
       ];
    foreach($arEnums as $enums)
    {
        CIBlockPropertyEnum::Add($enums);
    }


    }
}


?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

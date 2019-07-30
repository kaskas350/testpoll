<?php
class poll_results extends CBitrixComponent {

    public function getFields() {

        $arCodeProperties = [
            "POL",
            "ROD_DEYATELNOSTI",
            "AGE"
        ];
        $arResult=[];
        $elements = CIBlockElement::GetList([],[
            "IBLOCK_CODE" => 'forma',
        ]);
        $arParameters=[];
        while($element = $elements->GetNextElement())
        {

            $properties = $element->GetProperties();
            $arParameters["POL"][$properties["POL"]["VALUE_ENUM_ID"]]++;
            $arParameters["AGE"][$properties["AGE"]["VALUE_ENUM_ID"]]++;
            $arIdElements =[];
            foreach ($properties["ROD_DEYATELNOSTI"]["VALUE"] as $val)
            {
                $arIdElements[] = $val;
                $arResult["ROD_DEYATELNOSTI"]["VARIABLE"][$val]["COUNT"]++;
            }
        }
        $elements = CIBlockElement::GetList([],[
             "IBLOCK_CODE" => 'ROD_DEYATELNOSTI',
        ]);

        while($element = $elements->Fetch())
        {
            $arResult["ROD_DEYATELNOSTI"]["VARIABLE"][$element["ID"]]["NAME"] = $element["NAME"];
        }


		$objCIBlock = new CIBlock;
		$blocks = CIBlock::GetList([],[
		"CODE"=>"forma"
		]);
		$idBlock = ($blocks->Fetch())["ID"];
		

        $properties = CIBlock::GetProperties($idBlock);
        while($property = $properties->Fetch())
        {
            if (in_array($property["CODE"],$arCodeProperties))
            {
                $arResult[$property["CODE"]]["NAME"]=$property["NAME"];
                if ($property["CODE"] !== "ROD_DEYATELNOSTI")
                {
                $objEnum = CIBlockPropertyEnum::GetList([],[
                    "PROPERTY_ID"=>$property["ID"]
                ]);

                while ($enum = $objEnum->Fetch())
                {
                    $arResult[$property["CODE"]]["VARIABLE"][] = [
                        "NAME"=>$enum["VALUE"],
                        "COUNT"=>$arParameters[$enum["PROPERTY_CODE"]][$enum["ID"]]
                    ];
                }
            }
            }
        }
        return $arResult;


    }





    public function executeComponent()
    {
        if (CModule::IncludeModule("iblock"))
        {
            $this->arResult = $this->getFields();
        }

        $this->includeComponentTemplate();
    }


}
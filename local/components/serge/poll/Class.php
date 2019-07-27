<?php

class poll extends CBitrixComponent
{
    public $career;
    public $user;

    public function onPrepareComponentParams($arParams){
        $this->user = $arParams["USER"];
    }

    public function getCareer()
    {
        $careers = CIBlockElement::GetList([], [
            "IBLOCK_ID" => 6
        ], false, false, ["NAME", "CODE"]);
        $arCareer = [];
        while ($career = $careers->Fetch()) {
            $arCareer[] = [
                "NAME" => $career["NAME"],
                "ID" => $career["CODE"]
            ];
        }
        return $arCareer;
    }

    public function getForms()
    {
       $objBlock = new CIBlock;
        $blocks = CIBlock::GetList([],["CODE"=>"forma"]);
       $block = $blocks->Fetch();
        $properties =$objBlock->GetProperties($block["ID"]);
        $arResult = [];
        while ($property = $properties->Fetch()) {
            $this->arResult["FIELDS"][$property["CODE"]] = [
                "NAME" => $property["NAME"]
            ];
            if ($property["PROPERTY_TYPE"] == 'L') {
                $propertyEnums = CIBlockPropertyEnum::GetList([], [
                    "PROPERTY_ID" => $property["ID"]
                ]);
                while ($propertyEnum = $propertyEnums->Fetch()) {
                    $arResult["FIELDS"][$property["CODE"]]["enum"][$propertyEnum["ID"]] = $propertyEnum["VALUE"];
                }
            }
            if ($property["CODE"] == "ROD_DEYATELNOSTI") {
                $arResult["FIELDS"][$property["CODE"]]["career"] = $this->getCareer();
            }
        }
        return $arResult;
    }

    public function usersValidate()
    {
        $idUser="";
        if ($this->user->IsAuthorized()){
            $idUser = $this->user->GetID();
        } else {
            $idUser = session_id();
        }
            $elements = CIBlockElement::GetList([],[
                "IBLOCK_ID"=>5,
                "PROPERTY_ID"=>$idUser
            ]);
            $element = $elements->Fetch();
            return (!empty($element))?true:false;
    }

    public function executeComponent()
    {
        if (CModule::IncludeModule("iblock")) {
            $this->arResult["DATA"] = $this->getForms();
            $this->arResult["USER"] = $this->usersValidate();
        }
        $this->includeComponentTemplate();
    }


}
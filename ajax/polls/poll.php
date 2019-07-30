<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")) {
    
	
	if (empty($_GET["name"]) || (empty($_GET["family"])) || (empty($_GET["career"]))) {
        echo "N";
        die;
    }
    $idUser = "";
    if ($USER->IsAuthorized()) {
        $idUser = $USER->GetID();
    } else {
        $idUser = session_id();
    }
    $elements = CIBlockElement::GetList([], [
        "IBLOCK_CODE" => 'forma',
        "PROPERTY_ID" => $idUser
    ]);
    $element = $elements->Fetch();
    if (!empty($element)) {
        echo "Error";
        die;
    }
    $newPoll = new CIBlockElement;
    $objCareers = CIBlockElement::GetList([], [
          "IBLOCK_CODE" => 'ROD_DEYATELNOSTI',
        "CODE" => $_GET["career"]
    ], false, false, ["ID"]);
    $arIdCareer = [];
    while ($idCareer = $objCareers->Fetch()) {
        $arIdCareer[] = $idCareer["ID"];
    };
    unset($objCareers);
    unset($idCareer);
	
	
	$enums = CIBlockPropertyEnum::GetList([],[
	"XML_ID"=>[$_GET["pol"],$_GET["age"]]
	]);
	
	$arEnums = [];
	
	while($enum = $enums->Fetch())
	{
		$arEnums[$enum["PROPERTY_CODE"]] = $enum["ID"];
	}
	$blocks = CIBlock::GetList([],["CODE"=>"forma"]);
	$block = $blocks->Fetch();
    $arFields = [
        "NAME" => $_GET["name"] . " " . $_GET["family"],
        "IBLOCK_ID" => $block["ID"],
        "PROPERTY_VALUES" => [
            "IMYA" => $_GET["name"],
            "FAMILIYA" => $_GET["family"],
            "ROD_DEYATELNOSTI" => $arIdCareer,
            "POL" => $arEnums["POL"],
            "AGE" => $arEnums["AGE"]
        ]
    ];
    if ($USER->IsAuthorized()) {
        $arFields["PROPERTY_VALUES"]["ID"] = $USER->GetID();
    } else {
        $arFields["PROPERTY_VALUES"]["ID"] = session_id();
    }
	
    if($newPoll->Add($arFields)){
		
		echo "Yes";
	} else {
		echo "No";
		
	};
	die;
}
?>



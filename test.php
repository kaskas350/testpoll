<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>
<?

if (CModule::IncludeModule("iblock")) {
    $objCIBlock = new CIBlockType;
	$objCIBlock->Delete('test');
	die;
	
	$elements = CIBlockType::GetList();
	while($element = $elements->Fetch())
	{
		pr($element);
	}
	
	 $careers = CIBlockElement::GetList([], [
            "IBLOCK_CODE" => "ROD_DEYATELNOSTI"
        ], false, false, ["NAME", "CODE"]);
        $arCareer = [];
        while ($career = $careers->Fetch()) {
           pr($career);
        }
		
		$xs = CIBlockPropertyEnum::GetList();
		while($x = $xs->Fetch()) {
			pr($x);
		}
		
		for($i = 1;$i<=200;$i++) {
			CIBlockPropertyEnum::Delete($i);
		
		}

}


?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

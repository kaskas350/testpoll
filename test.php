<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>
<?

if (CModule::IncludeModule("iblock")) {
    $xs = CIBlockPropertyEnum::GetList();

    for ($i=1;$i<=100;$i++)
    {
        CIBlockPropertyEnum::Delete($i);
    }

    while($x = $xs->Fetch())
    {
        pr($x);
    }



    CIBlockType::Delete("test");
    $typeIBlocks = CIBlockType::GetByID("test");
    $typeIBlock = $typeIBlocks->Fetch();

pr($typeIBlock);


}


?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

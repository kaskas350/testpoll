<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест"); ?><?

?>


<?
if (\Bitrix\Main\Loader::includeModule('mymodulee'))
{
$x = new Bitrix\Mymodulee\UserTable();

$c = $x->getTitle();
pr($c);

}


?>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
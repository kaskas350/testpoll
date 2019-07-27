<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опрос");
?>

<?
global $USER;
$APPLICATION->IncludeComponent("serge:poll",
    "",
    ["USER"=>$USER]);

?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

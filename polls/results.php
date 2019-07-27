<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты опроса");
?>
<?

$APPLICATION->IncludeComponent("serge:poll.results",
    "",
    []);

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

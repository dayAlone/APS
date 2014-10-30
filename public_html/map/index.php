<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Карта сайта');
?>
<h1 class="page__title">Карта сайта</h1>
<div class="page__divider page__divider--blue l-margin-top xl-margin-bottom"></div>
<?
$APPLICATION->IncludeComponent(
  "bitrix:main.map", 
  ".default", 
  array(
    "LEVEL" => "4",
    "COL_NUM" => "2",
    "SHOW_DESCRIPTION" => "Y",
    "SET_TITLE" => "N",
    "CACHE_TIME" => "36000",
    "CACHE_TYPE" => "A"
  ),
  false
);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
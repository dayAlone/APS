<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Каталог оборудования');
$APPLICATION->SetPageProperty('body_class', "catalog catalog-category");

require($_SERVER['DOCUMENT_ROOT'].'/include/catalog.php');

$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog", array(
    "IBLOCK_TYPE"  => "news",
    "IBLOCK_ID"    => "1",
    "TOP_DEPTH"    => "4",
    "CACHE_TYPE"   => "A",
    "CACHE_NOTES"   => $_GLOBALS['openCatalogSection'],
    "SECTION_USER_FIELDS" => array("UF_SVG")
),
false
);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
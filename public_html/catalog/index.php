<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('section', array('IBLOCK'=>1, 'CODE'=>'catalog'));
require($_SERVER['DOCUMENT_ROOT'].'/include/section.php');

if(!isset($_REQUEST['ELEMENT_CODE'])&&!isset($_GLOBALS['currentCatalogSection']) || isset($_GLOBALS['openCatalogSection'])):
  $APPLICATION->SetTitle('Каталог оборудования');
  $APPLICATION->SetPageProperty('body_class', "catalog catalog-category");
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
elseif(intval($_GLOBALS['currentCatalogSection'])>0):
  $APPLICATION->SetPageProperty('body_class', "catalog");
  $APPLICATION->IncludeComponent(
  "bitrix:news.list", 
  "catalog",
  array(
    "IBLOCK_ID"   => 1,
    "NEWS_COUNT"  => "10",
    "SORT_BY1"    => "SORT",
    "SORT_ORDER1" => "ASC",
    "DETAIL_URL"  => "/catalog/#ELEMENT_CODE#/",
    "CACHE_TYPE"  => "A",
    "SET_TITLE"   => "N",
    "PARENT_SECTION"  => $_GLOBALS['currentCatalogSection']
  ),
  false
);
else:
  $APPLICATION->SetPageProperty('body_class', "catalog");
  $APPLICATION->IncludeComponent("bitrix:news.detail","catalog",Array(
    "IBLOCK_ID"     => 1,
    "ELEMENT_CODE"  => $_REQUEST['ELEMENT_CODE'],
    "CHECK_DATES"   => "N",
    "IBLOCK_TYPE"   => "content",
    "SET_TITLE"     => "Y",
    "CACHE_TYPE"    => "A",
    "PROPERTY_CODE" => array("PHOTOS", "ABOUT", "ADDITIONAL"),
  ));
endif;
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
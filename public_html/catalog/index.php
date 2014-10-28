<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
require($_SERVER['DOCUMENT_ROOT'].'/include/catalog.php');

if(!isset($_REQUEST['ELEMENT_CODE'])&&!isset($_GLOBALS['currentCatalogSection'])):

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
  $APPLICATION->SetPageProperty('body_class', "catalog catalog-list");
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
  $APPLICATION->IncludeComponent("bitrix:news.detail","catalog",Array(
    "IBLOCK_ID"     => 1,
    "ELEMENT_CODE"  => $_REQUEST['ELEMENT_CODE'],
    "CHECK_DATES"   => "N",
    "IBLOCK_TYPE"   => "content",
    "SET_TITLE"     => "Y",
    "CACHE_TYPE"    => "A",
    "FIELD_CODE"    => array("PREVIEW_TEXT"),
    "PROPERTY_CODE" => array(
          1 => "YEAR",
          2 => "ENGINE",
          3 => "CABINE",
          4 => "COMPLECT",
          5 => "BODY",
          6 => "MASS",
          7 => "PLACE",
          8 => "AVAILABILITY",
          9 => "STATUS",
          10 => "TYPE",
          11 => "TRANSMISSION",
          12 => "PRICE",
          13 => "PRICE_SALE",
          14 => "CHASSIS",
          15 => "DEPRECIATION",
          16 => "PHOTOS",
          17 => "WORK",
          18 => "PRICE_ORDER"
        ),
  ));
endif;
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
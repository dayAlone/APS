<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Аргус Пайплайн Сервис');
$APPLICATION->SetPageProperty('body_class', "index");

$APPLICATION->IncludeComponent(
  "bitrix:news.list", 
  "slider",
  array(
    "IBLOCK_ID"     => 3,
    "NEWS_COUNT"    => "9999999",
    "SORT_BY1"      => "SORT",
    "SORT_ORDER1"   => "ASC",
    "DETAIL_URL"    => "/",
    "PROPERTY_CODE" => Array("LINK", "LINK_TEXT"),
    "CACHE_TYPE"    => "A",
    "SET_TITLE"     => "N",
  ),
  false
);
$APPLICATION->IncludeComponent(
  "bitrix:news.list", 
  "news_index",
  array(
    "IBLOCK_ID"   => 2,
    "NEWS_COUNT"  => "1",
    "SORT_BY1"    => "ACTIVE_FROM",
    "SORT_ORDER1" => "DESC",
    "DETAIL_URL"  => "/news/#ELEMENT_CODE#/",
    "CACHE_TYPE"  => "A",
    "SET_TITLE"   => "N",
  ),
  false
);
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "sections_index", array(
    "IBLOCK_TYPE"  => "news",
    "IBLOCK_ID"    => "1",
    "TOP_DEPTH"    => "1",
    "CACHE_TYPE"   => "A",
    "SECTION_USER_FIELDS" => array("UF_SVG")
),
false
);?>
  <div class="partners">
    <div class="container"><a href="#" class="partners__item"><img src="./layout/images/l-1.jpg"></a><a href="#" class="partners__item"><img src="./layout/images/l-2.jpg"></a><a href="#" class="partners__item"><img src="./layout/images/l-3.jpg"></a><a href="#" class="partners__item"><img src="./layout/images/l-4.jpg"></a><a href="#" class="partners__item"><img src="./layout/images/l-5.jpg"></a><a href="#" class="partners__item"><img src="./layout/images/l-6.jpg"></a><a href="#" class="partners__item"><img src="./layout/images/l-7.jpg"></a></div>
  </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
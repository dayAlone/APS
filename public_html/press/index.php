<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('section', array('IBLOCK'=>2, 'CODE'=>'news', 'SORT'=>array('NAME'=>'DESC')));
require($_SERVER['DOCUMENT_ROOT'].'/include/section.php');
?>
<div class="page__title"><h1>Пресс-центр</h1></div>
<div class="page__divider page__divider--blue l-margin-top xl-margin-bottom"></div>
<div class="row">
  <div class="col-xs-12 col-sm-3 col-md-2">
    <?
    $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "years_list", array(
        "IBLOCK_TYPE"  => "news",
        "IBLOCK_ID"    => "2",
        "TOP_DEPTH"    => "1",
        "CACHE_TYPE"   => "A",
        "CACHE_NOTES"  => $_GLOBALS['currentCatalogSection']
    ),
    false
    );?>
  </div>
  <div class="col-xs-12 col-sm-9 col-md-10 border-left border-left--move">
  <?
  $APPLICATION->SetPageProperty('body_class', "news");
  if(!isset($_REQUEST['ELEMENT_CODE'])||intval($_GLOBALS['currentCatalogSection'])>0):
    $APPLICATION->SetTitle('Пресс-центр');
    $APPLICATION->IncludeComponent(
    "bitrix:news.list", 
    "news",
    array(
      "IBLOCK_ID"   => 2,
      "NEWS_COUNT"  => "10",
      "SORT_BY1"    => "ACTIVE_FROM",
      "SORT_ORDER1" => "DESC",
      "DETAIL_URL"  => "/press/#ELEMENT_CODE#/",
      "CACHE_TYPE"  => "A",
      "SET_TITLE"   => "N",
      "PARENT_SECTION"  => $_GLOBALS['currentCatalogSection']
    ),
    false
  );
  else:
    $APPLICATION->IncludeComponent("bitrix:news.detail","detail",Array(
      "IBLOCK_ID"     => 2,
      "ELEMENT_CODE"  => $_REQUEST['ELEMENT_CODE'],
      "CHECK_DATES"   => "N",
      "IBLOCK_TYPE"   => "content",
      "SET_TITLE"     => "Y",
      "CACHE_TYPE"    => "A",
      "PROPERTY_CODE" => array("PHOTOS", "ABOUT", "ADDITIONAL"),
    ));
  endif;
  ?>
  </div>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
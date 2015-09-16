<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('section', array('IBLOCK'=>1, 'CODE'=>'catalog'));
require($_SERVER['DOCUMENT_ROOT'].'/include/section.php');

if(!isset($_REQUEST['ELEMENT_CODE']) && !isset($_GLOBALS['currentCatalogSection'])):
  $APPLICATION->SetTitle('Каталог оборудования');
  $APPLICATION->SetPageProperty('body_class', "catalog catalog-category");
  ?>
  <div class="page__title"><h1>Каталог оборудования</h1></div>
  <?
      $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog_rows", array(
          "IBLOCK_TYPE"         => "news",
          "IBLOCK_ID"           => "1",
          "TOP_DEPTH"           => "1",
          "CACHE_TYPE"          => "A",
          "CACHE_NOTES"         => $_GLOBALS['openCatalogSection'],
          "SECTION_USER_FIELDS" => array("UF_SVG")
      ),
      false
      );
   ?>
<?
elseif(intval($_GLOBALS['openCatalogSection']) > 0 || intval($_GLOBALS['currentCatalogSection'])>0):?>
    <div class="row">
        <div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
            <?
                $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog_side", array(
                    "IBLOCK_ID"           => "1",
                    "CACHE_NOTES"          => (intval($_GLOBALS['currentCatalogSection'])>0 ? $_GLOBALS['currentCatalogSection'] : (intval($_GLOBALS['openCatalogSection']) > 0 ? $_GLOBALS['openCatalogSection'] : "")),
                    "SMALL"               => "Y",
                    "SECTION_USER_FIELDS" => array("UF_SVG"),
                    "TOP_DEPTH"           => "5"
                ),
                false
                );
             ?>
        </div>
        <div class="col-lg-9 col-md-8">
            <?if(intval($_GLOBALS['openCatalogSection']) > 0):
                $APPLICATION->SetPageProperty('body_class', "catalog catalog-category");
                ?>
                <div class="page__title"><h1><?=$APPLICATION->ShowTitle()?></h1></div>
                <?
                    $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog_rows", array(
                        "IBLOCK_ID"           => "1",
                        "SECTION_ID"          => $_GLOBALS['openCatalogSection'],
                        "SMALL"               => "Y",
                        "SECTION_USER_FIELDS" => array("UF_SVG")
                    ),
                    false
                    );
                 ?>
            <?
            elseif(intval($_GLOBALS['currentCatalogSection'])>0):
              $APPLICATION->SetPageProperty('body_class', "catalog");
              $APPLICATION->IncludeComponent(
              "bitrix:news.list",
              "catalog",
              array(
                "IBLOCK_ID"      => 1,
                "NEWS_COUNT"     => "10",
                "SORT_BY1"       => "SORT",
                "SORT_ORDER1"    => "ASC",
                "DETAIL_URL"     => "/catalog/#ELEMENT_CODE#/",
                "CACHE_TYPE"     => "A",
                "SET_TITLE"      => "N",
                "PARENT_SECTION" => $_GLOBALS['currentCatalogSection']
              ),
              false
            );

          endif;?>
        </div>
    </div>



<?
$message = $APPLICATION->GetPageProperty('catalog_description');
if(strlen($message) > 0):?>
<div class="page__divider page__divider--blue l-margin-bottom l-margin-top"></div>
<div class="page__description">
    <?=$message?>
</div>
<?
endif;
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

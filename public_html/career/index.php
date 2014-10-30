<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
?>
<h1 class="page__title">Карьера</h1>
<div class="page__divider page__divider--blue l-margin-top xl-margin-bottom"></div>
<div class="row">
  <div class="col-md-8 col-md-push-4 border-left">
    <?
    $APPLICATION->SetPageProperty('body_class', "career");
    if(!isset($_REQUEST['ELEMENT_CODE'])):
      ?>
      <p>Сегодня в нашей компании открыты следующие вакансии:</p>
      <?
      $APPLICATION->SetTitle('Карьера');
      $APPLICATION->IncludeComponent(
      "bitrix:news.list", 
      "career",
      array(
        "IBLOCK_ID"   => 5,
        "NEWS_COUNT"  => "10",
        "SORT_BY1"    => "SORT",
        "SORT_ORDER1" => "ASC",
        "DETAIL_URL"  => "/career/#ELEMENT_CODE#/",
        "CACHE_TYPE"  => "A",
        "SET_TITLE"   => "N"
      ),
      false
    );
    else:
      $APPLICATION->IncludeComponent("bitrix:news.detail","career",Array(
        "IBLOCK_ID"     => 5,
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
  <div class="col-md-4 col-md-pull-8 side">
    <p>Главная ценность любой компании – её коллектив. Промышленный холдинг ТКС – это сплочённая команда единомышленников, чья целеустремлённость и увлечённость общим делом помогли нам стать одним из лидеров рынка неразрушающего контроля и автоматической сварки в России. Мы находимся в постоянном поиске активных, творческих и энергичных людей, специалистов, которые пополнят наш дружный коллектив.</p>
    {GALLERY:153}
  </div>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Контакты');
$APPLICATION->SetPageProperty('body_class', "contacts text");?>
<h1 class="page__title">контакты</h1>
<div class="page__divider page__divider--blue l-margin-top xl-margin-bottom"></div>
<div class="row">
  <div class="col-sm-8">
    <big><strong>Адрес: </strong>Россия, Москва, <nobr>ул. Усачева, 35А</nobr> <br><strong>Телефон: </strong><a href="tel:88002005001">8 800 200 500 1<br></a><strong>E-mail: </strong><a href="mailto:info@oooaps.ru">info@oooaps.ru</a></big><br>
  </div>
  <div class="col-sm-4 right">
    <div class="xs-center md-right"><a data-toggle="modal" data-target="#Feedback" href="#Feedback" class="no-margin-top button button--big">напишите нам</a></div>
  </div>
</div>
<div id="map" data-coords="55.723171,37.559856" class="xl-margin-top l-margin-bottom"></div>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;load=package.full" type="text/javascript"></script>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetPageProperty('body_class', "contacts text");?>
<div class="page__title"><h1>контакты</h1></div>
<div class="page__divider page__divider--blue l-margin-top xl-margin-bottom"></div>
<div class="row">
  <div class="col-sm-8">
    <big><strong>Адрес: </strong>Россия, Москва, <nobr>ул. Усачева, д. 35А</nobr> <br><strong>Тел.: </strong><a href="tel:88005553136">8 800 555-31-36<br></a><strong>E-mail: </strong><a href="mailto:info@oooaps.ru">info@oooaps.ru</a></big><br>
<h2>Схема проезда</h2>
<div id="map" data-coords="55.723171,37.559856" class="xl-margin-top l-margin-bottom"></div>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;load=package.full" type="text/javascript"></script>
  </div>

</br>
  <div class="col-sm-4">
    <div class="xs-center md-right m-margin-top no-margin-top-sm"><a data-toggle="modal" data-target="#Feedback" href="#Feedback" class="no-margin-top button button--big">напишите нам</a></div>
  </div>
	  <div class="col-sm-8">
<h2>Реквизиты организации</h2>
	    <big>Юридическое лицо: Общество с ограниченной ответственностью «Аргус Пайплайн Сервис»</nobr> <br>Юридический адрес: 119048, г. Москва, ул. Усачева, д. 35, корп. 1<br>ИНН: 7714803302<br>ОГРН: 1107746203234</big><br>
	  </div>

</div><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
<!DOCTYPE html><html lang='ru'>
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/seo.php"); ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<?php if($_SERVER['REQUEST_URI']=="/")
{echo '<meta name=\'yandex-verification\' content=\'5348297a5e991261\' />';}?>
  <?
  $APPLICATION->SetAdditionalCSS("/layout/css/frontend.css", true);
  $APPLICATION->AddHeadScript('/layout/js/frontend.js');
  if($_SERVER['SERVER_NAME'] == 'aps.local') $APPLICATION->AddHeadScript('http://127.0.0.1:35729/livereload.js?ext=Safari&extver=2.0.9');
  $APPLICATION->ShowViewContent('header');?>
  <title><?php if(isset($seotitle) AND $seotitle!=''){echo $seotitle;}
                else
				{$APPLICATION->ShowTitle();
    if($APPLICATION->GetCurDir()!='/') {
      $rsSites = CSite::GetByID(SITE_ID);
      $arSite  = $rsSites->Fetch();
      echo ' | ' . $arSite['NAME'];
    }}
    ?></title>
  <?
    $APPLICATION->ShowHead();
  ?>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-64173680-1', 'auto');
ga('send', 'pageview');

</script>

</head>
<body class="<?=$APPLICATION->AddBufferContent("body_class");?>">
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter30932296 = new Ya.Metrika({id:30932296,
webvisor:true,
clickmap:true,
trackLinks:true,
accurateTrackBounce:true});
} catch(e) { }
});

var n = d.getElementsByTagName("script")[0],
s = d.createElement("script"),
f = function () { n.parentNode.insertBefore(s, n); };
s.type = "text/javascript";
s.async = true;
s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

if (w.opera == "[object Opera]") {
d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/30932296" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<div class="wrap" <?=(isset($_GLOBALS['BG_IMAGE'])?"style='background-image:url(".$_GLOBALS['BG_IMAGE'].")'":"")?>>
  <div id="panel"><?$APPLICATION->ShowPanel();?></div>
  <header class="toolbar">
    <div class="container hidden-xs hidden-sm">
      <div class="row no-gutter">
        <div class="col-md-3">
          <a href="/" class="logo"><?=svg('logo')?></a>
          <div class="shield">
            <div class="shield__right"><?=svg('shield-r')?></div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="row toolbar__tools">
            <div class="col-xs-2">
              <?php
              $APPLICATION->IncludeComponent("bitrix:menu", "sites",
              array(
                  "ALLOW_MULTI_SELECT" => "Y",
                  "MENU_CACHE_TYPE"    => "A",
                  "ROOT_MENU_TYPE"     => "sites",
                  "MAX_LEVEL"          => "1",
                  ),
              false);
              ?>
            </div>
            <div class="col-xs-3">
              <div data-variant="russian,english" class="lang-trigger lang-trigger--lang_russian s-margin-left"><span class="lang-trigger__label">RU</span><span class="lang-trigger__carriage"></span><span class="lang-trigger__label">EN</span></div>
            </div>
            <div class="col-xs-3 right">
              <a href="tel:<?=str_replace(' ', '', COption::GetOptionString("grain.customsettings","toolbar_phone"))?>" class="toolbar__phone"><?=svg('phone')?></svg><?=COption::GetOptionString("grain.customsettings","toolbar_phone")?></a>
            </div>
			<div style="color: white; float: left; font-size: 10px; padding-right: 20px;" class="toolbar__time">Пн. - Пт.: 09:00 - 18:00</div>
			<div style="color: white; float: left; font-size: 10px;" class="toolbar__time">Суб., Воскр. - выходные дни</div>
			<!--noindex-->
            <div class="col-xs-4 right">
              <a data-toggle="modal" data-target="#Feedback" href="#Feedback" class="feedback visible-md-inline visible-lg-inline">Обратная связь</a>
              <form action="/search/" class="search-form">
                <input type="text" name="q" class="search-form__text" placeholder="">
                <button type="submit" class="search-form__button"><?=svg('seach')?></button>
              </form>
              <a href="#" class="search-trigger m-margin-left"><?=svg('seach')?></a>
            </div>
			<!--/noindex-->
          </div>
          <div class="toolbar__nav">
            <?
              $APPLICATION->IncludeComponent("bitrix:menu", "top",
              array(
                  "ALLOW_MULTI_SELECT" => "Y",
                  "MENU_CACHE_TYPE"    => "A",
                  "ROOT_MENU_TYPE"     => "top",
                  "MAX_LEVEL"          => "1",
                  ),
              false);
              ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container visible-sm visible-xs">
        <div class="row no-gutter-sm">
          <div class="col-sm-4 col-xs-7 xs-center sm-left">
            <a href="/" class="logo"><?=svg('logo')?></a>
            <div class="shield">
              <div class="shield__right"><?=svg('shield-r')?></div>
            </div>
          </div>
          <div class="col-sm-8 col-xs-5">
            <div class="row toolbar__tools">
              <div class="col-sm-3 visible-sm">
                <div data-variant="russian,english" class="lang-trigger lang-trigger--lang_russian"><span class="lang-trigger__label">RU</span><span class="lang-trigger__carriage"></span><span class="lang-trigger__label">EN</span></div>
              </div>
              <div class="col-sm-5 right visible-sm">
                <a href="tel:<?=str_replace(' ', '', COption::GetOptionString("grain.customsettings","toolbar_phone"))?>" class="toolbar__phone"><?=svg('phone')?></svg><?=COption::GetOptionString("grain.customsettings","toolbar_phone")?></a>
              </div>
              <div class="col-xs-6 col-sm-2 sm-center no-padding-left">
                <a data-toggle="modal" data-target="#Contacts" href="#Contacts" class="visible-xs-inline s-margin-right"><?=svg('phone')?></a>
                <a data-toggle="modal" data-target="#Search" href="#Search"><?=svg('seach')?></a>

              </div>
              <div class="col-xs-6 col-sm-2 right">
                <a data-toggle="modal" data-target="#Nav" href="#Nav"><span>Меню</span><?=svg('nav')?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?/*
    <div class="container">
      <div class="row no-gutter-md">
        <div class="col-xs-3 visible-md visible-lg">
          <a href="/" class="logo"><?=svg('logo')?></a>
          <div class="shield shield--big-left">
            <div class="shield__right"><?=svg('shield-r')?></div>
          </div>
        </div>
        <div class="col-xs-12 col-md-9 no-padding-right-md">
          <div class="row">
            <div class="col-xs-3 col-md-2">
              <?php
              $APPLICATION->IncludeComponent("bitrix:menu", "sites",
              array(
                  "ALLOW_MULTI_SELECT" => "Y",
                  "MENU_CACHE_TYPE"    => "A",
                  "ROOT_MENU_TYPE"     => "sites",
                  "MAX_LEVEL"          => "1",
                  ),
              false);
              ?>

            </div>
            <div class="col-xs-2 col-lg-3">
              <a data-toggle="modal" data-target="#Contacts" href="#Contacts" class="popup-trigger"><?=svg('phone')?></a>
              <a data-toggle="modal" data-target="#Search" href="#Search" class="popup-trigger"><?=svg('seach')?></a>
              <div data-variant="russian,english" class="lang-trigger lang-trigger--lang_russian"><span class="lang-trigger__label">RU</span><span class="lang-trigger__carriage"></span><span class="lang-trigger__label">EN</span></div>
            </div>
            <div class="col-xs-3 md-right"><a href="tel:<?=str_replace(' ', '', COption::GetOptionString("grain.customsettings","toolbar_phone"))?>" class="phone"><?=svg('phone')?></svg><?=COption::GetOptionString("grain.customsettings","toolbar_phone")?></a></div>
            <div class="col-xs-4 col-md-5 col-lg-4 right">

              <a data-toggle="modal" data-target="#Feedback" href="#Feedback" class="feedback visible-md-inline visible-lg-inline">Обратная связь</a>
              <a data-toggle="modal" data-target="#Nav" href="#Nav" class="nav-trigger"><span>Меню</span><?=svg('nav')?></a>
              <form action="/search/" class="search-form">
                <input type="text" name="q" class="search-form__text" placeholder="">
                <button type="submit" class="search-form__button"><?=svg('seach')?></button>
              </form>
              <a href="#" class="search-trigger"><?=svg('seach')?></a></div>
          </div>
          <div class="row visible-md visible-lg">
            <div class="col-xs-12">
              <?
              $APPLICATION->IncludeComponent("bitrix:menu", "top",
              array(
                  "ALLOW_MULTI_SELECT" => "Y",
                  "MENU_CACHE_TYPE"    => "A",
                  "ROOT_MENU_TYPE"     => "top",
                  "MAX_LEVEL"          => "1",
                  ),
              false);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    */?>
  </header>
  <main class="page">

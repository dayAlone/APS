</div>
<?
if($APPLICATION->GetPageProperty('popup')):?>
<div id="<?=$APPLICATION->GetPageProperty('popup')?>" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
      <?=$APPLICATION->GetPageProperty('popup_content')?>
    </div>
  </div>
</div>
<?endif;?>
<?$APPLICATION->ShowViewContent('footer');?>
<div id="Nav" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
      <div data-variant="russian,english" class="lang-trigger lang-trigger--lang_russian"><span class="lang-trigger__label">RU</span><span class="lang-trigger__carriage"></span><span class="lang-trigger__label">EN</span></div>
      <?php
        $APPLICATION->IncludeComponent("bitrix:menu", "left_popup", 
        array(
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE"    => "A",
            "ROOT_MENU_TYPE"     => "left",
            "MAX_LEVEL"          => "1",
            ),
        false);?>
    </div>
  </div>
</div>
<div id="Sites" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
      <div class="modal-title">Сайты холдинга</div>
      <?php
        $APPLICATION->IncludeComponent("bitrix:menu", "left_popup", 
        array(
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE"    => "A",
            "ROOT_MENU_TYPE"     => "sites",
            "MAX_LEVEL"          => "1",
            ),
        false);?>
    </div>
  </div>
</div>
<div id="Search" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
      <div class="modal-title">Поиск</div>
      <form class="search">
        <input type="text" name="q" class="search__input">
        <button type="submit" value="" class="search__submit"><?=svg('seach')?>
        </button>
      </form>
    </div>
  </div>
</div>
<div id="Contacts" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
      <div class="modal-title">связаться с нами</div><a href="tel:+78002005001" class="phone">8 800 200 500 1</a>
      <div class="full-width center"><a href="#" class="form-trigger">напишите нам</a></div>
      <?
        require($_SERVER['DOCUMENT_ROOT'].'/include/form.php');
      ?>
    </div>
  </div>
</div>
<div id="Feedback" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content modal-content--white"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
    <?
      require($_SERVER['DOCUMENT_ROOT'].'/include/form.php');
    ?>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-sm-3 col-sm-4 col-md-3">
        <div class="copyright">© 2014 ООО «аргус пайплайн сервис» </div>
      </div>
      <div class="col-sm-3 col-md-2">
        <div class="contacts"><span><?=COption::GetOptionString("grain.customsettings","footer_address")?> <br></span><a href="mailto:<?=COption::GetOptionString("grain.customsettings","footer_email")?>" class="contacts_link"><?=COption::GetOptionString("grain.customsettings","footer_email")?></a></div>
      </div>
      <div class="col-sm-2">
        <div class="map"><a href="/map/">карта сайта</a></div>
      </div>
      <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2 social">
        <nobr>
        <?php
            $APPLICATION->IncludeComponent("bitrix:menu", "social", 
            array(
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE"    => "A",
                "ROOT_MENU_TYPE"     => "social",
                "MAX_LEVEL"          => "1",
                ),
            false);
        ?>
        </nobr>
      </div>
      <div class="col-md-3 col-lg-3 visible-md-block visible-lg-block"><a href="http://radia.ru" target="_blank" class="radia"><?=svg('radia')?>
          <div class="radia__content">разработка сайта <br>radia interactive</div></a></div>
    </div>
  </div>
</footer>
</body>
</html>
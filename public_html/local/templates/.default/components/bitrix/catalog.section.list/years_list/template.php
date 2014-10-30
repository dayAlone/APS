<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
?>
<div class="years">
      <?foreach ($arResult['SECTIONS'] as $key => &$item):?>
      	 <a href="/press/<?=$item['NAME']?>/" class="years__item <?=($arParams["CACHE_NOTES"]==$item['ID']?'years__item--active':'')?>"><?=$item['NAME']?></a>
      <?endforeach;?>
</div>
<?endif;?>
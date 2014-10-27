<?if(count($arResult['ITEMS'])>0):?>
<div class="news">
	<div class="container">
	  <div class="news__frame">
	    <?foreach ($arResult['ITEMS'] as $item):?>
		  <div class="news__item">
		    <div class="news__date"><?=$item['ACTIVE_FROM']?></div>
		    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="news__title"><?=$item['NAME']?></a>
		  </div>
		<?endforeach;?>
		<a href="#" class="news__more">к другим новостям</a>
	  </div>
	</div>
</div>
<?endif;?>
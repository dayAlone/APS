<div class="slider fotorama" data-width="100%" data-height="80%" data-minheight="640" data-nav="false" data-autoplay="true" data-transition="crossfade" data-loop="true">
	<?foreach ($arResult['ITEMS'] as $item):?>
		<div style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)" class="slider__item slider__item--<?=$item['PROPERTIES']['POSITION']['VALUE_XML_ID']?>">
		  <div class="container">
		    <h1 class="slider__title"><?=$item['NAME']?></h1>
		    <div class="slider__content">
		      <p><?=$item['PREVIEW_TEXT']?></p>
		      <a href="<?=$item['PROPERTIES']['LINK']['VALUE']?>" class="slider__link"><?=$item['PROPERTIES']['LINK_TEXT']['VALUE']?></a>
		    </div>
		  </div>
		</div>
	<?endforeach;?>
</div>
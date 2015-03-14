<?
$item = $arResult;
?>
<div class="news-item">
	<div class="news-item__date"><?=r_date($item['ACTIVE_FROM'])?></div>
	<h1 class="news-item__title"><?=$item['NAME']?></h1>
	<div class="news-item__text">
		<?if($item["DETAIL_PICTURE"]):?>
			<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="pull-right news-item__image">
		<?endif;?>
		<?=$item["~DETAIL_TEXT"]?>
	</div>
	<div class="news-item__gallery" data-images='<?=json_encode($item["GALLERY"])?>'>
	<?foreach ($item["GALLERY"] as $img):?>
		<a href="#" class="news-item__small-image" style="background-image: url(<?=$img['small']?>)"></a>
	<?endforeach;?>
	</div>
	<a href="/press/" class="news-item__back"><?=svg('back')?> <span>вернуться к списку новостей</span></a>
</div>
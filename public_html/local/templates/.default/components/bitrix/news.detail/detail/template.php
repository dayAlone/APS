<?
$item = $arResult;
?>
<div class="news-item">
	<div class="news-item__date"><?=$item['ACTIVE_FROM']?></div>
	<h1 class="news-item__title"><?=$item['NAME']?></h1>
	<div class="news-item__text">
		<?if($item["DETAIL_PICTURE"]):?>
			<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="pull-right news-item__image">
		<?endif;?>
		<?=$item["~DETAIL_TEXT"]?>
	</div>
	<?foreach ($item["GALLERY"] as $img):?>
		<img src="<?=$img['value']?>">
	<?endforeach;?>
</div>
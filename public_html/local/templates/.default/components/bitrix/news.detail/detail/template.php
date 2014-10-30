<?
$item = $arResult;
?>
<div class="news-item">
	<div class="news-item__date"><?=$item['ACTIVE_FROM']?></div>
	<h1 class="news-item__title"><?=$item['NAME']?></h1>
	<?=$item["~DETAIL_TEXT"]?>
	<?foreach ($item["GALLERY"] as $img):?>
		<img src="<?=$img['value']?>">
	<?endforeach;?>
</div>
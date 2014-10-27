<?
$item = $arResult;
if(isset($item['ACTIVE_FROM'])):
?>
<div class="date"><?=$item['ACTIVE_FROM']?></div>
<div class="divider"></div>
<?endif;?>
<h1 data-url="<?=$item['DETAIL_PAGE_URL']?>" class="hidden"><?=$item['NAME']?></h1>
<div class="row">
	<div class="col-md-12">
		<div data-width="100%" data-height="438" class="fotorama">
			<?foreach ($item["IMAGES"] as $img):?>
				<img src="<?=$img['value']?>">
			<?endforeach;?>
		</div>
	</div>
</div>
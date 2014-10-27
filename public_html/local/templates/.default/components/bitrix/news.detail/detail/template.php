<?
$item = $arResult;
if(isset($item['ACTIVE_FROM'])):
?>
<div class="date"><?=$item['ACTIVE_FROM']?></div>
<div class="divider"></div>
<?endif;?>
<h1 data-url="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></h1>
<div class="row">
	<div class="col-md-<?=(count($item["GALLERY"])>0?"7":"12")?>">
	  <?=$item["~DETAIL_TEXT"]?>
	</div>
	<?if(count($item["GALLERY"])>0):?>
	<div class="col-md-5">
		<div class="fotorama" data-width="100%" data-loop="true" data-ratio="800/600">
			<?foreach ($item["GALLERY"] as $img):?>
				<img src="<?=$img['value']?>">
			<?endforeach;?>
		</div>
	</div>
	<?endif;?>
</div>
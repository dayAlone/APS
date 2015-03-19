<?
	$section = end($arResult['SECTION']['PATH']);
?>
<h1 class="page__title"><?=$section['NAME']?></h1>
<div class="page__divider"></div>
<div class="products">
<?
	foreach ($arResult['ITEMS'] as $item):
	?>
		<div class="products__item">
			<div class="row">
				<?if(strlen($item['PREVIEW_PICTURE']['SRC'])>0):?>
				<div class="col-xs-12 col-sm-3 col-md-2">
					<a href="<?=$item['DETAIL_PAGE_URL']?>" class="products__image" style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)"></a>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9">
				<?else:?>
				<div class="col-xs-12 col-sm-8 col-md-9 col-sm-offset-3 col-md-offset-2">
				<?endif;?>
					<a href="<?=$item['DETAIL_PAGE_URL']?>" class="products__name"><?=$item['NAME']?></a>
					<div class="products__text">
						<?=$item['PREVIEW_TEXT']?>
					</div>
				</div>
			</div>
		</div>
	<?
	endforeach;
?>
</div>
<?=$arResult["NAV_STRING"]?>
<?require_once($_SERVER['DOCUMENT_ROOT'].'/include/dropdown.php')?>

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
				<div class="col-sm-2">
					<a href="<?=$item['DETAIL_PAGE_URL']?>" class="products__image" style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)"></a>
				</div>
				<div class="col-sm-9">
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

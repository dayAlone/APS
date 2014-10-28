<?
$res = CIBlockSection::GetByID($arParams['PARENT_SECTION']);
if($ar_res = $res->GetNext()){
	global $APPLICATION;
	$APPLICATION->SetTitle($ar_res['NAME']);
}
?>
<h1 class="page__title"><?=$ar_res['NAME']?></h1>
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
				<div class="col-sm-8">
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
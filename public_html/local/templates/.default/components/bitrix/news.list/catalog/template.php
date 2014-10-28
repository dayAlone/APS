<div class="products">
	<?
		$res = CIBlockSection::GetByID($arParams['PARENT_SECTION']);
		if($ar_res = $res->GetNext()){
			global $APPLICATION;
			$APPLICATION->SetTitle($ar_res['NAME']);
		}
		?>
		<h1 class="page__title"><?=$ar_res['NAME']?></h1>
		<div class="page__divider"></div>
		<?
		foreach ($arResult['ITEMS'] as $item):
		?>
			<div class="products__item">
				
			</div>
		<?
		endforeach;
	?>
</div>
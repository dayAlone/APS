<div class="nav-popup">
	<?foreach ($arResult as $key=>$item):?>
		<a href="<?=$item['LINK']?>" class="nav-popup__item <?=($item['SELECTED']?'nav-popup__item--active':'')?>"><?=$item['TEXT']?></a>
	<?endforeach;?>
</div>
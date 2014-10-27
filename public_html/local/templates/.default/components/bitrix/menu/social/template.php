<?foreach ($arResult as $key=>$item):?>
	<a href="<?=$item['LINK']?>" class="social__item"><?=svg($item['TEXT'])?></a>
<?endforeach;?>
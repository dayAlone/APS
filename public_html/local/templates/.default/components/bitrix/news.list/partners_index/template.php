<div class="partners">
    <div class="container">
        <?foreach ($arResult['ITEMS'] as $item):?>
            <?if(strlen($item['LINK'])>0):?>
                <a href="#" class="partners__item">
            <?else:?>
                <span class="partners__item">
            <?endif;?>
                <img src="<?=$item['IMAGE']?>">
            <?if(strlen($item['LINK'])>0):?>
            </a>
            <?else:?>
            </span>
            <?endif;?>
        <?endforeach;?>
    </div>
</div>
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
    $arSections = $arResult['SECTIONS'];
    if(isset($arParams['CACHE_NOTES'])) {
        $rsPath = GetIBlockSectionPath($arResult['IBLOCK_ID'], $arParams['CACHE_NOTES']);
        $treeSections = array();
        while($arPath = $rsPath->GetNext())
          $treeSections[] = (int)$arPath['ID'];

    }
    function showChild($item, $treeSections) {
        if(count($item['CHILD'])>0):
            $class = "";
            for ($i=0; $i < $item['DEPTH']-1; $i++)
                $class .= "sub-";
            ?><div class="<?=$class?>sections__content">
                <?$class .= "sub-";?>
                <div class="<?=$class?>sections"><?
                    foreach ($item['CHILD'] as $item):
                        ?>
                        <div class="<?=$class?>sections__item <?=(in_array($item['ID'], $treeSections)?$class."sections__item--open":"")?>">
                            <a href="<?=$item['URL']?>" class="<?=$class?>sections__title <?=(count($item['CHILD'])==0?$class."sections__title--link":"")?>">
                                <?=($item['DEPTH'] >= 2 ? svg('arrow4') : "")?>
                                <?=$item['NAME']?>
                            </a>
                            <?
                                if(in_array($item['ID'], $treeSections)) showChild($item, $treeSections);
                            ?>
                        </div>
                        <?
                    endforeach;
                    ?>
                </div>
            </div><?
        endif;
    }
?>
<div class="sections sections--side">
	<?foreach ($arSections as $key => &$item):?>
        <div class="sections__item <?=(in_array($item['ID'], $treeSections)?"sections__item--open":"")?>" data-id="<?=$item['ID']?>">
            <a href="<?=$item['URL']?>" class="sections__title">
              <div class="sections__name"><?=$item['NAME']?></div>
            </a>
            <? if(in_array($item['ID'], $treeSections)) showChild($item, $treeSections); ?>
        </div>
    <?endforeach;?>
</div>
<?endif;?>

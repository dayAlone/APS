<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
    $arSections = $arResult['SECTIONS'];
    if(isset($arParams['CACHE_NOTES'])) {
        $rsPath = GetIBlockSectionPath($arResult['IBLOCK_ID'], $arParams['CACHE_NOTES']);
        $treeSections = array();
        while($arPath = $rsPath->GetNext())
          $treeSections[] = $arPath['ID'];
    }
?>

<div class="sections">
	<?foreach ($arSections as $key => &$item):
        $hasChild   = false;
        $firstChild = false;
        
        if(isset($arSections[$key+1]['DEPTH_LEVEL']) && $arSections[$key+1]['DEPTH_LEVEL'] > $item['DEPTH_LEVEL'])
            $hasChild = true;

        if(isset($arSections[$key-1]['DEPTH_LEVEL'])):
            if($arSections[$key-1]['DEPTH_LEVEL'] < $item['DEPTH_LEVEL'])
                $firstChild = true;
            if($arSections[$key-1]['DEPTH_LEVEL'] > $item['DEPTH_LEVEL'])
                for ($i=0; $i < $arSections[$key-1]['DEPTH_LEVEL']-$item['DEPTH_LEVEL']+2; $i++)
                    echo "</div>";
        endif;

        switch ($item['DEPTH_LEVEL']):
            case 1:
                ?>
                    <div class="sections__item <?=(in_array($item['ID'], $treeSections)?"sections__item--open":"")?>" data-id="<?=$item['ID']?>">
                        <a href="<?=(!$hasChild?$item['SECTION_PAGE_URL']:"#")?>" style="background-image: url(<?=$item['PICTURE']['SRC']?>)" class="sections__title">
                          <div class="sections__icon"><?=file_get_contents($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($item['UF_SVG']))?></svg>
                          </div>
                          <div class="sections__name"><?=$item['NAME']?></div>
                        </a>
                <?
                    if(!$hasChild):
                        echo "</div>";
                    else:
                        ?><div class="sections__content"><?
                    endif;
                break;
            default:
                $class = "";
                for ($i=0; $i < $item['DEPTH_LEVEL']-1; $i++)
                    $class .= "sub-";
                if($firstChild):
                    ?><div class="<?=$class?>sections"><?
                endif;?>
                <div class="<?=$class?>sections__item <?=(in_array($item['ID'], $treeSections)?$class."sections__item--open":"")?>">
                    <a href="<?=(!$hasChild?$item['SECTION_PAGE_URL']:"#")?>" class="<?=$class?>sections__title <?=(!$hasChild?$class."sections__title--link":"")?>">
                        <?=($item['DEPTH_LEVEL']==2?svg('arrow3'):"")?>
                        <?=$item['NAME']?>
                    </a>
                <?
                if(!$hasChild):
                    echo "</div>";
                else:
                    ?><div class="<?=$class?>sections__content"><?
                endif;
            break;
        endswitch;

        if(!isset($arSections[$key+1]['DEPTH_LEVEL']))
            for ($i=0; $i < $item['DEPTH_LEVEL']+2; $i++)
                echo "</div>";
    endforeach;?>
</div>
<?if(intval($treeSections[0])>0):?>
<script>
    $(function(){
        $("html").velocity("scroll", { offset: $('div[data-id="<?=$treeSections[0]?>"]').offset().top});
    })
</script>
<?endif;?>
<?endif;?>
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
    $arSections = $arResult['SECTIONS'];
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
                    <div class="sections__item">
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
                <div class="<?=$class?>sections__item">
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
    endforeach;?>
</div>
<?endif;?>
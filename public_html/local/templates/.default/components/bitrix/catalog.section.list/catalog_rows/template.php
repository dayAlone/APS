<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
?>
<div class="sections">
    <div class="row">
	<?
    $i = 0;
    foreach ($arResult['SECTIONS'] as $key => &$item):
        if($arParams['SMALL'] == 'Y') {
            if($i % 3 == 0) { ?> <div class="col-lg-12 visible-lg"></div><? }
            if($i % 2 == 0) { ?> <div class="col-md-12 visible-md"></div><? }
        } else {
            if($i % 4 == 0) { ?> <div class="col-lg-12 visible-lg"></div><? }
            if($i % 3 == 0) { ?> <div class="col-md-12 visible-md"></div><? }
            if($i % 2 == 0) { ?> <div class="col-sm-12 visible-sm"></div><? }
        }
        ?>
        <div class=" <?=($arParams['SMALL']=='Y'?"col-md-6 col-lg-4":"col-md-4 col-lg-3 col-sm-6")?> col-xs-12">
            <div class="section" data-id="<?=$item['ID']?>">
                <a href="<?=$item['URL']?>" class="section">
                    <span class="section__image" style="background-image: url(<?=$item['IMAGE']?>)">
                        <?if(!$item['IMAGE']):?><span class="section__icon section__icon--blue"><?=$item['ICON']?></span><?endif;?>
                    </span>
                    <span class="section__name"><?=$item['NAME']?></span>
                </a>
            </div>
        </div>
    <?
    $i++;
    endforeach;?>
    </div>
</div>
<?endif;?>

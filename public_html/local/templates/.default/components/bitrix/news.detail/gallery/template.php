<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="gallery">
    <?
	foreach ($arResult['PHOTOS'] as $img):?>
        <a href="<?=$img['value']?>" rel="prettyPhoto[]" style="background-image: url(<?=$img['small']?>)" class="gallery__item"></a>
    <? endforeach;?>
</div>

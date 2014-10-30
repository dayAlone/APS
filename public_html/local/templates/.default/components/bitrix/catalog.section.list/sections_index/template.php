<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
?>
<div class="sections">
	<div class="container">
		<?foreach ($arResult['SECTIONS'] as $key => &$item):?>
		<a href="/catalog/<?=$item['CODE']?>/" class="sections__item">
    		<div class="sections__image">
    			<?=file_get_contents($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($item['UF_SVG']))?>
    		</div>
    		<div class="sections__text"><?=$item['NAME']?></div>
    	</a>
    	<?endforeach;?>
    </div>
</div>
<style type="text/css">
    .index .sections__item {
        width: <?=100/count($arResult['SECTIONS'])?>%;
    }
</style>
<?endif;?>
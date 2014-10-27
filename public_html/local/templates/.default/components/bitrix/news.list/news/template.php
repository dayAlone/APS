<div class="news">
<?foreach ($arResult['ITEMS'] as $item):?>
  <a data-toggle="modal" data-target="#newsDetail" href="#newsDetail" class="news__item" data-url="<?=$item['DETAIL_PAGE_URL']?>">
    <div class="news__frame">
    <?if(isset($item['PREVIEW_PICTURE']['SRC'])):?>
      <div style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)" class="news__picture"></div>
    <?endif;?>
      <div class="news__date"><?=$item['ACTIVE_FROM']?></div>
      <div class="news__title"><?=$item['NAME']?></div>
    </div>
  </a>
<?endforeach;?>
</div>
<div class="center">
  <?=$arResult["NAV_STRING"]?>
</div>
<?$this->SetViewTarget('footer');?>
   <div id="newsDetail" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-content--white">
    	<a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
    	<div class="text">
    		
    	</div>
    </div>
  </div>
</div>
<?$this->EndViewTarget();?> 
<div class="news-list">
<?foreach ($arResult['ITEMS'] as $item):?>
  <div class="news-list__item">
    <div class="news-list__date"><?=r_date($item['ACTIVE_FROM'])?></div>
    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="news-list__title"><?=$item['NAME']?></a>
    <div class="news-list__text"><?=$item['PREVIEW_TEXT']?></div>
  </div>
<?endforeach;?>
</div>

<?=$arResult["NAV_STRING"]?>

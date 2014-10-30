<div class="career-list">
<?foreach ($arResult['ITEMS'] as $item):?>
  <div class="career-list__item">
    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="career-list__title"><?=$item['NAME']?></a>
  </div>
<?endforeach;?>
</div>

<?=$arResult["NAV_STRING"]?>

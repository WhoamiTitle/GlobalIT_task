<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<?php if (!empty($arResult['ITEMS'])): ?>
  <?php foreach ($arResult['ITEMS'] as $arItem): ?>
    <?php
    $this->addEditAction(
        $arItem['ID'],
        $arItem['EDIT_LINK'],
        CIBlock::getArrayById($arItem['IBLOCK_ID'], 'ELEMENT_EDIT')
    );
    $this->addDeleteAction(
        $arItem['ID'],
        $arItem['DELETE_LINK'],
        CIBlock::getArrayById($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'),
        ['CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM') ?: 'Удалить этот элемент?']
    );
    $previewPicture = $arItem['PREVIEW_PICTURE'] ?? null;
    ?>
    <div class="catalog-item" id="<?= $this->getEditAreaId($arItem['ID']); ?>">
      <div class="catalog-item-image">
        <?php if ($previewPicture): ?>
          <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
            <img src="<?= $previewPicture['SRC']; ?>" alt="<?= $previewPicture['ALT']; ?>" title="<?= $previewPicture['TITLE']; ?>"/>
          </a>
        <?php else: ?>
          <span class="catalog-item-image-placeholder">Нет изображения</span>
        <?php endif; ?>
      </div>
      <div class="catalog-item-body">
        <div class="catalog-item-title">
          <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>"><?= $arItem['NAME']; ?></a>
        </div>
        <?php if (!empty($arItem['PREVIEW_TEXT'])): ?>
          <div class="catalog-item-desc-float">
            <?= $arItem['PREVIEW_TEXT']; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <div class="catalog-list-empty">Список услуг временно пуст.</div>
<?php endif; ?>

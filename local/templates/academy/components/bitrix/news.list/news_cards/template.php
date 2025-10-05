<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
?>
<?php if (!empty($arResult['ITEMS'])): ?>
  <div class="news-cards">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
      <?php
      $this->addEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::getArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
      $this->addDeleteAction(
          $arItem['ID'],
          $arItem['DELETE_LINK'],
          CIBlock::getArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'),
          ['CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM') ?: 'Удалить запись?']
      );
      $date = $arItem['DISPLAY_ACTIVE_FROM'] ?: $arItem['ACTIVE_FROM'];
      $source = $arItem['PROPERTIES']['SOURCE']['VALUE'] ?? '';
      ?>
      <article class="news-card" id="<?= $this->getEditAreaId($arItem['ID']); ?>">
        <?php if (!empty($arItem['PREVIEW_PICTURE'])): ?>
          <a class="news-card__media" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
            <img src="<?= htmlspecialcharsbx($arItem['PREVIEW_PICTURE']['SRC']); ?>" alt="<?= htmlspecialcharsbx($arItem['PREVIEW_PICTURE']['ALT'] ?: $arItem['NAME']); ?>"/>
          </a>
        <?php endif; ?>
        <div class="news-card__body">
          <?php if ($date): ?>
            <div class="news-card__meta">
              <span class="news-card__date"><?= $date; ?></span>
              <?php if ($source): ?>
                <span class="news-card__source">Источник: <?= htmlspecialcharsbx($source); ?></span>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <h2 class="news-card__title">
            <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>"><?= $arItem['NAME']; ?></a>
          </h2>
          <?php if (!empty($arItem['PREVIEW_TEXT'])): ?>
            <div class="news-card__preview">
              <?= $arItem['PREVIEW_TEXT']; ?>
            </div>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="catalog-list-empty">Новостей пока нет.</div>
<?php endif; ?>

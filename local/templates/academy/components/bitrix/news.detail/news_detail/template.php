<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

$date = $arResult['DISPLAY_ACTIVE_FROM'] ?: $arResult['ACTIVE_FROM'];
$source = $arResult['PROPERTIES']['SOURCE']['VALUE'] ?? '';
$detailText = $arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT'];
$detailImage = $arResult['DETAIL_PICTURE'] ?: $arResult['PREVIEW_PICTURE'];
?>
<div class="news-detail">
  <div class="news-detail__back">
    <a href="<?= htmlspecialcharsbx($arResult['LIST_PAGE_URL']); ?>">← ко всем новостям</a>
  </div>
  <article class="news-detail__card">
    <?php if ($detailImage): ?>
      <div class="news-detail__media">
        <img src="<?= htmlspecialcharsbx($detailImage['SRC']); ?>" alt="<?= htmlspecialcharsbx($detailImage['ALT'] ?: $arResult['NAME']); ?>"/>
      </div>
    <?php endif; ?>
    <div class="news-detail__body">
      <div class="news-detail__meta">
        <?php if ($date): ?><span class="news-detail__date"><?= $date; ?></span><?php endif; ?>
        <?php if ($source): ?><span class="news-detail__source">Источник: <?= htmlspecialcharsbx($source); ?></span><?php endif; ?>
      </div>
      <h1 class="news-detail__title"><?= $arResult['NAME']; ?></h1>
      <?php if ($detailText): ?>
        <div class="news-detail__text">
          <?= $detailText; ?>
        </div>
      <?php endif; ?>
    </div>
  </article>
</div>

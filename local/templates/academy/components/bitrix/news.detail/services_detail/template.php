<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

$detailText = $arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT'];
$detailImage = $arResult['DETAIL_PICTURE'] ?: $arResult['PREVIEW_PICTURE'];
?>
<div class="service-detail">
  <div class="service-detail__back">
    <a href="<?= htmlspecialcharsbx($arResult['LIST_PAGE_URL']); ?>">← Вернуться к услугам</a>
  </div>
  <div class="service-detail__card">
    <?php if ($detailImage): ?>
      <div class="service-detail__media">
        <img src="<?= htmlspecialcharsbx($detailImage['SRC']); ?>" alt="<?= htmlspecialcharsbx($detailImage['ALT'] ?: $arResult['NAME']); ?>"/>
      </div>
    <?php endif; ?>
    <div class="service-detail__body">
      <h1 class="service-detail__title"><?= $arResult['NAME']; ?></h1>
      <?php if (!empty($detailText)): ?>
        <div class="service-detail__text">
          <?= $detailText; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

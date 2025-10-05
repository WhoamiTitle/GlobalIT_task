<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (empty($arResult)) {
    return;
}
?>
<nav class="nav">
  <?php foreach ($arResult as $item): ?>
    <?php
    $classes = ['nav__link'];
    if ($item['SELECTED']) {
        $classes[] = 'nav__link--active';
    }
    ?>
    <a class="<?= implode(' ', $classes); ?>" href="<?= htmlspecialcharsbx($item['LINK']); ?>">
      <?= htmlspecialcharsbx($item['TEXT']); ?>
    </a>
  <?php endforeach; ?>
</nav>

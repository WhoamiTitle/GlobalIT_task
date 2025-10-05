<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="news-list">
  <?php
  $APPLICATION->IncludeComponent(
      'bitrix:news.list',
      'news_cards',
      [
          'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
          'IBLOCK_ID' => $arParams['IBLOCK_ID'],
          'NEWS_COUNT' => $arParams['NEWS_COUNT'],
          'SORT_BY1' => $arParams['SORT_BY1'],
          'SORT_ORDER1' => $arParams['SORT_ORDER1'],
          'SORT_BY2' => $arParams['SORT_BY2'],
          'SORT_ORDER2' => $arParams['SORT_ORDER2'],
          'FIELD_CODE' => $arParams['LIST_FIELD_CODE'],
          'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
          'CHECK_DATES' => $arParams['CHECK_DATES'],
          'CACHE_TYPE' => $arParams['CACHE_TYPE'],
          'CACHE_TIME' => $arParams['CACHE_TIME'],
          'CACHE_FILTER' => $arParams['CACHE_FILTER'],
          'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
          'PARENT_SECTION' => $arResult['VARIABLES']['SECTION_ID'] ?? '',
          'PARENT_SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'] ?? '',
          'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
          'FILTER_NAME' => $arParams['FILTER_NAME'] ?? '',
          'ACTIVE_DATE_FORMAT' => $arParams['LIST_ACTIVE_DATE_FORMAT'],
          'DETAIL_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['detail'],
          'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
          'IBLOCK_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['news'],
          'SET_TITLE' => 'N',
      ],
      $component
  );
  ?>
</div>

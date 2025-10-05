<?php
/**
 * Создаёт инфоблок «Услуги» и наполняет тестовыми данными.
 * Запуск: php -f local/scripts/setup_services_iblock.php
 */

use Bitrix\Main\Loader;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (!Loader::includeModule('iblock')) {
    echo "Модуль iblock недоступен" . PHP_EOL;
    return;
}

$typeId = 'academy_content';
$type = CIBlockType::GetByID($typeId)->Fetch();
if (!$type) {
    echo "Тип {$typeId} отсутствует. Сначала запустите setup_news_iblock.php" . PHP_EOL;
    return;
}

$iblockCode = 'academy_services';
$iblockName = 'Услуги';
$siteId = defined('SITE_ID') ? SITE_ID : 's1';
$iblock = CIBlock::GetList([], ['TYPE' => $typeId, 'CODE' => $iblockCode])->Fetch();
if ($iblock) {
    $iblockId = (int)$iblock['ID'];
    echo "Инфоблок {$iblockName} (ID {$iblockId}) уже существует" . PHP_EOL;
} else {
    $ib = new CIBlock();
    $iblockId = (int)$ib->Add([
        'ACTIVE' => 'Y',
        'NAME' => $iblockName,
        'CODE' => $iblockCode,
        'TYPE' => $typeId,
        'SITE_ID' => [$siteId],
        'GROUP_ID' => [
            '1' => 'X',
            '2' => 'R',
        ],
        'LIST_PAGE_URL' => '#SITE_DIR#/services/',
        'SECTION_PAGE_URL' => '#SITE_DIR#/services/#SECTION_CODE#/',
        'DETAIL_PAGE_URL' => '#SITE_DIR#/services/#ELEMENT_ID#/',
        'VERSION' => 2,
    ]);

    if ($iblockId > 0) {
        echo "Инфоблок {$iblockName} создан (ID {$iblockId})" . PHP_EOL;
    } else {
        echo "Ошибка создания инфоблока: {$ib->LAST_ERROR}" . PHP_EOL;
        return;
    }
}

$elements = [
    [
        'NAME' => 'Дизайн-проект интерьера',
        'PREVIEW_TEXT' => 'Подготовим интерьерный проект с расстановкой мебели и подбором материалов.',
        'DETAIL_TEXT' => 'Специалисты дизайн-бюро создадут полный интерьерный проект: обмеры помещения, планировку, подбор мебели, отделочных материалов и текстиля. По итогам клиент получает визуализации и рабочие чертежи.',
    ],
    [
        'NAME' => 'Мебель на заказ',
        'PREVIEW_TEXT' => 'Изготовление корпусной и мягкой мебели по индивидуальным размерам.',
        'DETAIL_TEXT' => 'Производим мебель по индивидуальным размерам: кухни, шкафы-купе, гардеробные, мягкие уголки. В стоимость входит замер, 3D-визуализация и монтаж готовых изделий.',
    ],
    [
        'NAME' => 'Реставрация мебели',
        'PREVIEW_TEXT' => 'Восстановим внешний вид и функциональность любимых предметов.',
        'DETAIL_TEXT' => 'Мастерская выполняет реставрацию антикварной и современной мебели: восстановление покрытий, замену мягких элементов, укрепление конструкций. Возможен выезд мастера на дом.',
    ],
    [
        'NAME' => 'Профессиональная доставка',
        'PREVIEW_TEXT' => 'Собственная служба доставки с подъёмом и сборкой.',
        'DETAIL_TEXT' => 'Логистическая служба доставляет мебель в удобное время, поднимает в квартиру и производит сборку и настройку. Сервис доступен по городу и области.',
    ],
    [
        'NAME' => 'Сервисное обслуживание',
        'PREVIEW_TEXT' => 'Регулярное обслуживание мебели после покупки.',
        'DETAIL_TEXT' => 'Предлагаем сервисные программы: профилактический осмотр, подтяжку соединений, замену фурнитуры и чистку обивки. Услуга помогает продлить срок службы мебели.',
    ],
];

$element = new CIBlockElement();
foreach ($elements as $index => $item) {
    $code = 'service_' . ($index + 1);
    $exists = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        false,
        ['ID']
    )->Fetch();

    if ($exists) {
        echo "Элемент {$code} уже существует" . PHP_EOL;
        continue;
    }

    $item['IBLOCK_ID'] = $iblockId;
    $item['CODE'] = $code;
    $item['ACTIVE'] = 'Y';
    $item['PREVIEW_TEXT_TYPE'] = 'text';
    $item['DETAIL_TEXT_TYPE'] = 'text';

    $id = $element->Add($item);
    if ($id) {
        echo "Добавлен элемент {$code} (ID {$id})" . PHP_EOL;
    } else {
        echo "Ошибка добавления элемента {$code}: {$element->LAST_ERROR}" . PHP_EOL;
    }
}

echo 'Готово.' . PHP_EOL;

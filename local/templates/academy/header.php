<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/*
  Требования:
  1) Подключение своей таблицы стилей
  2) Панель администратора для авторизованных
  3) Заголовок страницы в <title>
*/
?><!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <?php $APPLICATION->ShowHead(); ?>
  <title><?php $APPLICATION->ShowTitle(); ?></title>
  <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/../.default/merged.css">
  <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/../.default/swiper-main.css">
  <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/styles.css">
</head>
<body class="page">
<?php
global $USER;
if ($USER->IsAuthorized()) {
  $APPLICATION->ShowPanel();
}
?>

<div class="page__wrapper" id="page-wrapper">
  <header class="header" id="header">
    <div class="page__container">
      <div class="header__inner">
        <button class="header__control" type="button" aria-label="Открыть главное меню">
          <span class="header__burger"></span>
        </button>
        <a class="header__logo" href="/">
          <img class="img" src="<?= SITE_TEMPLATE_PATH ?>/../.default/images/logo.png" alt="Academy">
        </a>
        <form class="header__form" action="/search/" method="get" role="search">
          <div class="header__search">
            <label class="visually-hidden" for="academy-search">Поиск по сайту</label>
            <input class="header__search-input" id="academy-search" name="q" type="search" placeholder="Поиск по сайту">
          </div>
          <button class="btn btn-primary" type="submit">Найти</button>
        </form>
        <div class="header__navigation">
          <nav class="nav">
            <a class="nav__link" href="/">Главная</a>
            <a class="nav__link" href="/about/">О проекте</a>
            <a class="nav__link" href="/contacts/">Контакты</a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <main class="page__body" id="content">
    <div class="page__container layout">
      <aside class="layout__sidebar" id="sidebar">
        <div class="sidebar__card">
          <div class="sidebar__title">Разделы</div>
          <ul class="sidebar__menu">
            <li><a href="/">Главная</a></li>
            <li><a href="/about/">О нас</a></li>
            <li><a href="/courses/">Курсы</a></li>
            <li><a href="/news/">Новости</a></li>
          </ul>
        </div>
      </aside>
      <div class="layout__content" id="workarea">

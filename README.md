
yii2-gridview-pagesize-widget
=============================

GridPageSize расширение для [Yii2](https://github.com/yiisoft/yii2)

Позволяет отображать список количества отображаемых записей и менять его в GridView на странице

Установка
---------

Желательно устанавливать через [composer](http://getcomposer.org/download/).

Запуск в консоли

```
composer require --prefer-dist zertex/yii2-gridview-pagesize-widget "*"
```

можно также добавить строку в `composer.json` в секцию `required`

```
"zertex/yii2-gridview-pagesize-widget": "*"
```


Использование
-------------

Вставьте виджет надо или под GridView в представлении:

~~~php
<?php echo \zertex\gridpagesize\GridPageSize::widget(); ?>
~~~

и установите `filterSelector` параметр в GridView как в примере.

~~~php
<?= GridView::widget([
     'dataProvider' => $dataProvider,
     'filterModel' => $searchModel,
		'filterSelector' => 'select[name="per-page"]',
     'columns' => [
         ...
     ],
 ]); ?>
~~~

Конфигурация
------------

Доступны следующие парамтры конфигурации виджета.

- `label`: Текст
- `defaultPageSize`: Количество записей на страницу по умолчанию
- `pageSizeParam`: Параметр запроса GET, содержащий значение количества записей на страницу
- `sizes`: Массив чисел, отображаемых в списке выбора количества записей
- `template`: Шаблон отображения элементов виджета. По умолчанию `'{label} {list}'`
- `options`: HTML атрибуты элемента `<select>`
- `labelOptions`: HTML атрибуты элемента `<label>`
- `encodeLabel`: Кодировать текст
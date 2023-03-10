@extends('layouts.app')

@section('content')

<style>
    .custom-border-col-right{
        border-right: 2px solid #ff8800;
    }
    .custom-border-col{
        border: 2px solid #ff8800;
        padding: 10px;
    }
</style>
<div class='container'>
    <div class='row text-center justify-content-center'>
        <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  custom-border-col-right'>
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="text" class="form-control change-attribute" id="phone" placeholder='+7 (999) 999-99-99' value='{{ $service->getPhone() }}'>
                <div id="phoneHelp" class="form-text">*обязательно</div>
            </div>
        </div>
        <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  custom-border-col-right'>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Уникальный номер</label>
                <input type="text" class="form-control" id='uniqueNumber' value='{{ $service->getUrl() }}' disabled>
                <div id="emailHelp" class="form-text">Ваш уникальный номер</div>
            </div>
        </div>
        <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 '>
            <div class="mb-3">
                <h5>Статистика</h5>
                <hr>
               <div class="row">
                    <span> Всего ссылок: {{ $service->getCountUrl() }}</span>
                    <span> Всего ссылок автивировано: {{ $service->getCountActiveUrl() }}</span>
                    <span> Количество участников, в ветках которых полностью активирован уровень PAYLEVEL : 0</span>
               </div>
            </div>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 custom-border-col'>
            <div class='row'>
                <div class="mb-3">
                    <span for="exampleInputEmail1" class="form-label">KOLSYL</span>
                    <input type="number" class="form-control change-config" id="KOLSYL" aria-describedby="getKOLSYL" value='{{ $serviceConfigurations->getKOLSYL() }}'>
                    <div id="KOLSYLHelp" class="form-text">количество ссылок, генерирующихся после активации аккаунта для передачи своим доверенным</div>
                </div>
            </div>

            <div class='row'>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">PAYLEVEL</label>
                    <input type="number" class="form-control change-config" id="PAYLEVEL" aria-describedby="PAYLEVEL"  value='{{ $serviceConfigurations->getPAYLEVEL() }}'>
                    <div id="PAYLEVELHelp" class="form-text">на каком уровне своей ветки каждый получает бонус от взносов</div>
                </div>
            </div>
            <div class='row'>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">PAYSUM</label>
                    <input type="number" class="form-control change-config" id="PAYSUM" aria-describedby="PAYSUM"  value='{{ $serviceConfigurations->getPAYSUM() }}'>
                    <div id="PAYSUMHelp" class="form-text">сумма, которую платит каждый участник за себя и за каждого доверенного, если соглашается участвовать в проекте</div>
                </div>
            </div>
            <div class='row'>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">PAYRESERVE</label>
                    <input type="number" class="form-control change-config" id="PAYRESERVE" aria-describedby="PAYRESERVE"  value='{{ $serviceConfigurations->getPAYRESERVE() }}'>
                    <div id="PAYRESERVEHelp" class="form-text">сумма, которую каждый участник обязуется перевести в конце первого этапа Проекта</div>
                </div>
            </div>
            <hr>
            <div class='row  justify-content-center'>
                <button type="button" class="btn btn-primary" style='max-width:130px;'>Старт</button>
            </div>
            <hr>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
            <button type="button" class="btn btn-primary" style='max-width:210px;' id='generate-url'>Сгенерировать ссылку</button>
        </div>
    </div>

    <hr>
    <div class='row'>
        <table id="jquery-datatable-example-no-configuration" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Дата создания</th>
                    <th>Уникальный номер</th>
                    <th>Копирование</th>
                    <th>Поделиться</th>
                    <th>Комментарий</th>
                    <th>Сохранить</th>
                </tr>
            </thead>
            <tbody>
                @foreach($service->getChildren() as $item)
                    <tr>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->url }}</td>
                        <th><button type="button" class="btn btn-primary">Копировать</button></th>
                        <th><button type="button" class="btn btn-primary">Поделиться</button></th>
                        <th><textarea class="form-control" rows="2" placeholder='Комментарий'></textarea></th>
                        <th><button type="button" class="btn btn-primary save-change-children-url">Сохранить</button></th>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection

@section('after_scripts')
    <script>
        $("#phone").mask("+7 (999) 999-99-99");

        $(document).ready(function() {
            $('#jquery-datatable-example-no-configuration').DataTable({
                language: {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    },
                    "select": {
                        "rows": {
                            "_": "Выбрано записей: %d",
                            "1": "Выбрана одна запись"
                        },
                        "cells": {
                            "_": "Выбрано %d ячеек",
                            "1": "Выбрана 1 ячейка "
                        },
                        "columns": {
                            "1": "Выбран 1 столбец ",
                            "_": "Выбрано %d столбцов "
                        }
                    },
                    "searchBuilder": {
                        "conditions": {
                            "string": {
                                "startsWith": "Начинается с",
                                "contains": "Содержит",
                                "empty": "Пусто",
                                "endsWith": "Заканчивается на",
                                "equals": "Равно",
                                "not": "Не",
                                "notEmpty": "Не пусто",
                                "notContains": "Не содержит",
                                "notStartsWith": "Не начинается на",
                                "notEndsWith": "Не заканчивается на"
                            },
                            "date": {
                                "after": "После",
                                "before": "До",
                                "between": "Между",
                                "empty": "Пусто",
                                "equals": "Равно",
                                "not": "Не",
                                "notBetween": "Не между",
                                "notEmpty": "Не пусто"
                            },
                            "number": {
                                "empty": "Пусто",
                                "equals": "Равно",
                                "gt": "Больше чем",
                                "gte": "Больше, чем равно",
                                "lt": "Меньше чем",
                                "lte": "Меньше, чем равно",
                                "not": "Не",
                                "notEmpty": "Не пусто",
                                "between": "Между",
                                "notBetween": "Не между ними"
                            },
                            "array": {
                                "equals": "Равно",
                                "empty": "Пусто",
                                "contains": "Содержит",
                                "not": "Не равно",
                                "notEmpty": "Не пусто",
                                "without": "Без"
                            }
                        },
                        "data": "Данные",
                        "deleteTitle": "Удалить условие фильтрации",
                        "logicAnd": "И",
                        "logicOr": "Или",
                        "title": {
                            "0": "Конструктор поиска",
                            "_": "Конструктор поиска (%d)"
                        },
                        "value": "Значение",
                        "add": "Добавить условие",
                        "button": {
                            "0": "Конструктор поиска",
                            "_": "Конструктор поиска (%d)"
                        },
                        "clearAll": "Очистить всё",
                        "condition": "Условие",
                        "leftTitle": "Превосходные критерии",
                        "rightTitle": "Критерии отступа"
                    },
                    "searchPanes": {
                        "clearMessage": "Очистить всё",
                        "collapse": {
                            "0": "Панели поиска",
                            "_": "Панели поиска (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Нет панелей поиска",
                        "loadMessage": "Загрузка панелей поиска",
                        "title": "Фильтры активны - %d",
                        "showMessage": "Показать все",
                        "collapseMessage": "Скрыть все"
                    },
                    "buttons": {
                        "pdf": "PDF",
                        "print": "Печать",
                        "collection": "Коллекция <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                        "colvis": "Видимость столбцов",
                        "colvisRestore": "Восстановить видимость",
                        "copy": "Копировать",
                        "copyKeys": "Нажмите ctrl or u2318 + C, чтобы скопировать данные таблицы в буфер обмена.  Для отмены, щелкните по сообщению или нажмите escape.",
                        "copyTitle": "Скопировать в буфер обмена",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Показать все строки",
                            "_": "Показать %d строк",
                            "1": "Показать 1 строку"
                        },
                        "removeState": "Удалить",
                        "renameState": "Переименовать",
                        "copySuccess": {
                            "1": "Строка скопирована в буфер обмена",
                            "_": "Скопировано %d строк в буфер обмена"
                        },
                        "createState": "Создать состояние",
                        "removeAllStates": "Удалить все состояния",
                        "savedStates": "Сохраненные состояния",
                        "stateRestore": "Состояние %d",
                        "updateState": "Обновить"
                    },
                    "decimal": ".",
                    "infoThousands": ",",
                    "autoFill": {
                        "cancel": "Отменить",
                        "fill": "Заполнить все ячейки <i>%d<i><\/i><\/i>",
                        "fillHorizontal": "Заполнить ячейки по горизонтали",
                        "fillVertical": "Заполнить ячейки по вертикали",
                        "info": "Информация"
                    },
                    "datetime": {
                        "previous": "Предыдущий",
                        "next": "Следующий",
                        "hours": "Часы",
                        "minutes": "Минуты",
                        "seconds": "Секунды",
                        "unknown": "Неизвестный",
                        "amPm": [
                            "AM",
                            "PM"
                        ],
                        "months": {
                            "0": "Январь",
                            "1": "Февраль",
                            "10": "Ноябрь",
                            "11": "Декабрь",
                            "2": "Март",
                            "3": "Апрель",
                            "4": "Май",
                            "5": "Июнь",
                            "6": "Июль",
                            "7": "Август",
                            "8": "Сентябрь",
                            "9": "Октябрь"
                        },
                        "weekdays": [
                            "Вс",
                            "Пн",
                            "Вт",
                            "Ср",
                            "Чт",
                            "Пт",
                            "Сб"
                        ]
                    },
                    "editor": {
                        "close": "Закрыть",
                        "create": {
                            "button": "Новый",
                            "title": "Создать новую запись",
                            "submit": "Создать"
                        },
                        "edit": {
                            "button": "Изменить",
                            "title": "Изменить запись",
                            "submit": "Изменить"
                        },
                        "remove": {
                            "button": "Удалить",
                            "title": "Удалить",
                            "submit": "Удалить",
                            "confirm": {
                                "_": "Вы точно хотите удалить %d строк?",
                                "1": "Вы точно хотите удалить 1 строку?"
                            }
                        },
                        "multi": {
                            "restore": "Отменить изменения",
                            "title": "Несколько значений",
                            "noMulti": "Это поле должно редактироватся отдельно, а не как часть групы",
                            "info": "Выбранные элементы содержат разные значения для этого входа.  Чтобы отредактировать и установить для всех элементов этого ввода одинаковое значение, нажмите или коснитесь здесь, в противном случае они сохранят свои индивидуальные значения."
                        },
                        "error": {
                            "system": "Возникла системная ошибка (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Подробнее<\/a>)."
                        }
                    },
                    "searchPlaceholder": "Что ищете?",
                    "stateRestore": {
                        "creationModal": {
                            "button": "Создать",
                            "search": "Поиск",
                            "columns": {
                                "search": "Поиск по столбцам",
                                "visible": "Видимость столбцов"
                            },
                            "name": "Имя:",
                            "order": "Сортировка",
                            "paging": "Страницы",
                            "scroller": "Позиция прокрутки",
                            "searchBuilder": "Редактор поиска",
                            "select": "Выделение",
                            "title": "Создать новое состояние",
                            "toggleLabel": "Включает:"
                        },
                        "removeJoiner": "и",
                        "removeSubmit": "Удалить",
                        "renameButton": "Переименовать",
                        "duplicateError": "Состояние с таким именем уже существует.",
                        "emptyError": "Имя не может быть пустым.",
                        "emptyStates": "Нет сохраненных состояний",
                        "removeConfirm": "Вы уверены, что хотите удалить %s?",
                        "removeError": "Не удалось удалить состояние.",
                        "removeTitle": "Удалить состояние",
                        "renameLabel": "Новое имя для %s:",
                        "renameTitle": "Переименовать состояние"
                    },
                    "thousands": " "
                }
            }
            );
        });

        /**
         * Изменение номера
         */
        function changeAttribute() {
            data = {
                url: $('#uniqueNumber').val(),
                phone: $('#phone').val()
            };

            $.ajax({
                url: '/change-attribute',
                method: 'post',
                dataType: "json",
                data: data,
                success: function(data){
                    toastr.success('Сохранено!');
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        alert('Not connect. Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found (404).');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error (500).');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error. ' + jqXHR.responseText);
                    }
                }
            });
        }

        /**
         * Изменение конфигурации
         */
         function changeConfig() {
            array = []
            data = {
                KOLSYL: $('#KOLSYL').val(),
                PAYLEVEL: $('#PAYLEVEL').val(),
                PAYSUM: $('#PAYSUM').val(),
                PAYRESERVE: $('#PAYRESERVE').val(),
            };

            data
            $.ajax({
                url: '/change-config',
                method: 'post',
                dataType: "json",
                data: data,
                success: function(data){
                    toastr.success('Сохранено!');
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        alert('Not connect. Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found (404).');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error (500).');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error. ' + jqXHR.responseText);
                    }
                }
            });
        }

        /**
         * Запрос на генерацию ссылки
         */
         function generateUrlRequest() {
            data = {
                url: $('#uniqueNumber').val(),
                count: 1,
            };

            $.ajax({
                url: '/generate-url',
                method: 'post',
                dataType: "json",
                data: data,
                success: function(data){
                    toastr.success('Ссылка сгенерирована!');
                    console.log(data)
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        alert('Not connect. Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found (404).');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error (500).');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error. ' + jqXHR.responseText);
                    }
                }
            });
        }

        $(document).on('change', '.change-attribute', function(){ changeAttribute() })
        $(document).on('change', '.change-config', function(){ changeConfig() })
        $(document).on('click', '#generate-url', function(){ generateUrlRequest() })
    </script>
@endsection

@section('description', 'AMISAMI Админская url')
@section('keywords', 'AMISAMI, Админская url')
@section('title', 'AMISAMI Админская url')
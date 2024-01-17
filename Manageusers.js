(function () {
    var $doc, changeSelection, dataSource, dragging, generateFakeUsers, ghost, initRow, pjs, propertiesSchema, refreshDataCount, refreshEditor, selectedObjs;
    pjs = null;
    selectedObjs = void 0;
    function saveDataToLocalStorage() {
        localStorage.setItem('dataSource', JSON.stringify(dataSource));
    }
    
    // Function to load data from local storage
    function loadDataFromLocalStorage() {
        var storedData = localStorage.getItem('dataSource');
        if (storedData) {
            dataSource = JSON.parse(storedData);
        }
    }
    changeSelection = function () {
        var row, selectedRows;
        selectedRows = $('.dataTable table tbody tr.selected');
        if (selectedRows.length > 0) {
            selectedObjs = function () {
                var j, len, results;
                results = [];
                for (j = 0, len = selectedRows.length; j < len; j++) {
                    row = selectedRows[j];
                    results.push($(row).data('obj'));
                }
                return results;
            }();
        }
        return refreshEditor();
    };
    refreshEditor = function () {
        return pjs = new PJS('.propertyEditor', propertiesSchema, selectedObjs);
    };
    dataSource = [];
    initRow = function (tr, item) {
        var ref, selectAllCell;
        selectAllCell = $('.dataTable table thead th.selectAll');
        tr.empty().append([
            $('<td/>').append($('<i/>').addClass('checkbox fa fa-square-o')),
            $('<td/>').text(item.name || '<empty>'),
            $('<td/>').text(item.username || '<empty>'),
            $('<td/>').text(item.email || '<empty>'),
        ]);
        tr.find('td:eq(0)').on('click', function (e) {
            var checkbox, state;
            e.preventDefault();
            checkbox = tr.find('input[type=checkbox]');
            state = tr.hasClass('selected');
            if (state) {
                state = false;
            } else {
                state = true;
            }
            tr.toggleClass('selected');
            selectAllCell.removeClass('selected');
            return changeSelection();
        });
        return tr.find('td:not(:eq(0))').on('click', function (e) {
            tr.addClass('selected').siblings().removeClass('selected');
            selectAllCell.removeClass('selected');
            return changeSelection();
        });
    };
    refreshDataCount = function () {
        return $('.header .count').text(dataSource.length);
    };
    $(function () {
        var rows, selectAllCell, tbody, thead;
        thead = $('.dataTable table thead');
        tbody = $('.dataTable table tbody');
        rows = [];
        selectAllCell = thead.find('th.selectAll');
        $.each(dataSource, function (i, item) {
            var tr;
            tr = $('<tr/>').attr('data-id', i).data('obj', item);
            initRow(tr, item);
            item.__row = tr;
            return rows.push(tr);
        });
        tbody.append(rows);
        refreshDataCount();
        selectAllCell.on('click', function (e) {
            if (selectAllCell.hasClass('selected')) {
                tbody.find('tr').removeClass('selected');
            } else {
                tbody.find('tr').addClass('selected');
            }
            selectAllCell.toggleClass('selected');
            return changeSelection();
        });
        $('.header .functions .add').on('click', function () {
            var obj, tr;
            selectedObjs = void 0;
            $('.dataTable tr.selected').removeClass('selected');
            refreshEditor();
            obj = pjs.getObject();
            dataSource.push(obj);
            selectedObjs = [obj];
            refreshDataCount();
            tr = $('<tr/>').data('obj', obj).addClass('selected');
            initRow(tr, obj);
            obj.__row = tr;
            tbody.append(tr);
            return $('.dataTable').stop().animate({ scrollTop: $('.dataTable table').height() }, 500);
        });
        return refreshEditor();
    });
    $doc = $(document);
    dragging = false;
    ghost = null;
    $('.slider').on('mousedown', function (e) {
        var offsetX, width;
        e.preventDefault();
        dragging = true;
        width = $('.page').width();
        offsetX = $('.page').offset().left;
        ghost = $('<div/>', {
            'class': 'ghostSlider',
            css: { left: $('.properties').offset().left - offsetX }
        }).appendTo($('.page'));
        $('.size').text(parseInt($('.properties').width()) + 'px').fadeIn('fast');
        $doc.on('mousemove', function (ev) {
            dragging = true;
            ghost.css({ left: ev.pageX - offsetX });
            return $('.size').text(parseInt(width - ev.pageX + offsetX) + 'px');
        });
        return $doc.on('mouseup', function (ev) {
            e.preventDefault();
            if (dragging) {
                $doc.off('mousemove mouseup');
                $('.properties').css({ 'flex': '0 0 ' + (width - ghost.offset().left + offsetX) + 'px' });
                ghost.remove();
                return dragging = false;
            }
        });
    });
    propertiesSchema = {
        liveEdit: true,
        editors: [
            {
                field: 'name',
                title: 'Name',
                type: 'text',
                required: true,
                multiEdit: false,
                featured: true
            },
            {
                field: 'username',
                title: 'Username',
                type: 'text',
                required: true,
                multiEdit: false,
                featured: true
            },
            {
                field: 'email',
                title: 'E-mail',
                type: 'email',
                required: false,
                multiEdit: false,
                validate: function (value, objs) {
                    if (!validateEmail(value)) {
                        return 'Invalid email address';
                    }
                }
            },
            {
                field: 'password',
                title: 'Password',
                type: 'password',
                placeHolder: 'Password',
                required: true,
                multiEdit: false,
                featured: true,
                toolTip: 'Enter the user\'s password',
                hint: 'Minimum 6 characters',
                validate: function (value, objs) {
                    if (!validatePassword(value)) {
                        return 'Password does not meet the criteria';
                    }
                }
            },
            {
                field: 'phone',
                title: 'Phone',
                type: 'text',
                required: false,
                multiEdit: true,
                hint: 'Format: 0-000-000-0000 x000'
            },
            {
                field: 'deleteAccount',
                title: 'Delete Account',
                type: 'button',
                schemaFunction: true,
                multiEdit: true,
                onclick: function (objs) {
                  if (confirm("Are you sure you want to delete the account(s)?")) {
                    $.each(objs, function (i, obj) {
                      dataSource = dataSource.filter(function (item) {
                        return item !== obj;
                      });
                      obj.__row.remove();
                    });
                    refreshDataCount();
                    selectedObjs = [];
                    refreshEditor();
                  }
                }
              }
        ],
        onChanged: function (editor, value, objs) {
            console.log('Field \'' + editor.fieldName + '\' value changed to \'' + value + '\'');
            return $.each(selectedObjs, function (i, item) {
                return initRow(item.__row, item);
            });
        }
    };
    function validateEmail(email) {
        // Regular expression pattern for email validation
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }
    function validatePassword(password) {
        // Regular expression pattern for password validation
        var pattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{6,}$/;
        return pattern.test(password);
    }
}.call(this));
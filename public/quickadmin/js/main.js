$(document).ready(function () {

    var activeSub = $(document).find('.active-sub');
    if (activeSub.length > 0) {
        activeSub.parent().show();
        activeSub.parent().parent().find('.arrow').addClass('open');
        activeSub.parent().parent().addClass('open');
    }

    $('.datatable').dataTable({
        retrieve: true,
        "iDisplayLength": 100,
        "aaSorting": [],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0]}
        ]
    });

    $('.ckeditor').each(function () {
        CKEDITOR.replace($(this));
    })

    $('.mass').click(function () {
        if ($(this).is(":checked")) {
            $('.single').each(function () {
                if ($(this).is(":checked") == false) {
                    $(this).click();
                }
            });
        } else {
            $('.single').each(function () {
                if ($(this).is(":checked") == true) {
                    $(this).click();
                }
            });
        }
    });

    $('.page-sidebar').on('click', 'li > a', function (e) {

        if ($('body').hasClass('page-sidebar-closed') && $(this).parent('li').parent('.page-sidebar-menu').size() === 1) {
            return;
        }

        var hasSubMenu = $(this).next().hasClass('sub-menu');

        if ($(this).next().hasClass('sub-menu always-open')) {
            return;
        }

        var parent = $(this).parent().parent();
        var the = $(this);
        var menu = $('.page-sidebar-menu');
        var sub = $(this).next();

        var autoScroll = menu.data("auto-scroll");
        var slideSpeed = parseInt(menu.data("slide-speed"));
        var keepExpand = menu.data("keep-expanded");

        if (keepExpand !== true) {
            parent.children('li.open').children('a').children('.arrow').removeClass('open');
            parent.children('li.open').children('.sub-menu:not(.always-open)').slideUp(slideSpeed);
            parent.children('li.open').removeClass('open');
        }

        var slideOffeset = -200;

        if (sub.is(":visible")) {
            $('.arrow', $(this)).removeClass("open");
            $(this).parent().removeClass("open");
            sub.slideUp(slideSpeed, function () {
                if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
                    if ($('body').hasClass('page-sidebar-fixed')) {
                        menu.slimScroll({
                            'scrollTo': (the.position()).top
                        });
                    }
                }
            });
        } else if (hasSubMenu) {
            $('.arrow', $(this)).addClass("open");
            $(this).parent().addClass("open");
            sub.slideDown(slideSpeed, function () {
                if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
                    if ($('body').hasClass('page-sidebar-fixed')) {
                        menu.slimScroll({
                            'scrollTo': (the.position()).top
                        });
                    }
                }
            });
        }
        if (hasSubMenu == true || $(this).attr('href') == '#') {
            e.preventDefault();
        }
    });

    var items = []; // items được khai báo chung.

if ($('#listchooseproduct').attr('data-ids')) {
     items = jQuery.parseJSON($('#listchooseproduct').attr('data-ids'));
}

$('#danhmucs_id').on('change', function() {
    console.log($(this).val());
    var url = '/datalistingproduct/';
    $.get(
        url,
        {},
        function(response) {
            if (response.status) {
                $('#listProducts').html();
                $('#listProducts').html(response.view);
            } else {
                alert(reponse.message);
            }
    });
});

$('body').on('click', '.btn-add', function() {
    var product =  $(this).attr('value');
    var item = jQuery.parseJSON(product);
    var head = "<tr id='" + item.id + "'><td align='center'>";
    var middle = "</td><td align='center'><button type='button' class='btn-remove btn-danger fa fa-close'></button></td><input type='hidden' name='productIds[]' value='";
    var end = "'></tr>";
    var flag = true;

    for (var index = 0; index < items.length; index++) {
        if (item.id == items[index]) {
            flag = false;
        }
    }

    if (flag) {
        $('#listchooseproduct').append(head + item.name + middle + item.id + end);
        items.push(item.id); // them vào mang item
    }
});

$('body').on('click', '.btn-remove', function() {
    for (var index = 0; index < items.length; index++) {
        if ($(this).closest('tr').attr('id') == items[index]) {
            items[index] = null;
            var idproduct= $(this).closest('tr').attr('id');
            var char = '';

            if ($('#productDeleteIds').val()) {
                char = ', ';
            }

            $('#productDeleteIds').val($('#productDeleteIds').val() + char + idproduct);

            $(this).closest('tr').remove();
        }
    }
});

$('body').on('click', '.pagination a', function(e) {
    e.preventDefault();
    var currentUrl = location.href;
    var page = $(this).attr('href').split('page=')[1];
    var url = $(this).attr('href');

    $.get(
        url,
        {},
        function(response) {
            if (response.status) {
                $('#listProducts').html();
                $('#listProducts').html(response.view);
                location.hash = page;
            } else {
                location.href = url.split('?page=')[0];
            }
    });
});

$('#alert-message').delay(5000).slideUp(700);


});

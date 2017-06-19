var items = []; // items được khai báo chung.

if ($('#listchooseproduct').attr('data-ids')) {
     items = jQuery.parseJSON($('#listchooseproduct').attr('data-ids'));
}

$('#danhmucs_id').on('change', function() {

    var id = $(this).val();
    var url = '/khl/getlistsanpham/'+id;
    $.get(
        url,
        {},
        function(response) {
            if (response.status) {
                $('#listProducts').html();
                $('#listProducts').html(response.view);
            } else {
                // alert(reponse.message);
            }
    });
});
 var d = 0;
$('body').on('click', '.btn-add', function() {
    var product =  $(this).attr('value');
    var item = jQuery.parseJSON(product);
    var head = "<tr id='" + item.id + "'><td align='center'> ";
    var end = "'></tr>";
    var flag = true;

    for (var index = 0; index < items.length; index++) {
        if (item.id == items[index]) {
            flag = false;
        }
    }

    if (flag) {

          var middle = "</td><td><input class='form-control' name='sanphams["+d+"][so_luong]' type='text' id='so_luong'></td><td><input class='form-control' name='sanphams["+d+"][don_gia]' type='text' id='don_gia'value='"+item.don_gia+"'></td><td align='center'><button type='button' class='btn-remove btn-danger fa fa-close'></button></td><input type='hidden' name='sanphams["+d+"][sanphams_id]' value='";
            console.log(d);
        $('#listchooseproduct').append(head + item.ten_sp + middle + item.id + end);
         d++;
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

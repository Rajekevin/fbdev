$(document).ready(function () {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });

    $('.toggler-activate').change(function () {
        var id    = $(this).data("id");
        var token = $(this).data("token");
        $.ajax({
            url     : "http://mickey.fbdev.fr/admin/users/activate/" + id,
            type    : 'PUT',
            dataType: "JSON",
            data    : {
                "id"     : id,
                "_method": 'PUT',
                "_token" : token,
            },
            success : function () {
                console.log("it Work");
            }
        });
    });
})
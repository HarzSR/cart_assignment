$(document).ready(function ()
{
    $("span.addToCart").on("click", function ()
    {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "ajax.php?id=" + id + "&action=add"
        }).done(function ()
        {
            alert("Product have been added.");
        });
    });
    $("span.removeFromCart").on("click", function ()
    {
        if(confirm('Are you Sure'))
        {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "ajax.php?id=" + id + "&action=remove"
            }).done(function ()
            {
                alert("Product have been removed.");
                location.reload();
            });
        }
    });
    $("a.emptyCart").on("click", function ()
    {
        if(confirm('Are you Sure'))
        {
            $.ajax({
                type: "GET",
                url: "ajax.php?action=empty"
            }).done(function ()
            {
                alert("Cart been emptied.");
                location.reload();
            });
        }
    });
});
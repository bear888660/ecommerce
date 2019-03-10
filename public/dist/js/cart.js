function flashCartItemsNum()
{
    $.ajax({
        method: "GET",
        url: `/cart/count-items`,
        })
    .done(jsonData => {

        const data = JSON.parse(jsonData);

        return (data.status) ? $('#shipping-badge').text(data.data.num) : null;
    });

}
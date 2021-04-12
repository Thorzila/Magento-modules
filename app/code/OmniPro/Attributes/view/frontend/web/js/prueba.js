define([
    'jquery'
], function($) {;
    var blogs = "/rest/V1/blogs?searchCriteria";
    $.getJSON({
        url : blogs
    }).done((resp)=>{
        var array = resp.items;
        array.forEach(item => {
            $("#content").append(item.title + "<br>");
            $("#content").append(item.content + "<br>");
            $("#content").append(item.email + "<br>");
            $("#content").append("<br>");
        });
    });
});

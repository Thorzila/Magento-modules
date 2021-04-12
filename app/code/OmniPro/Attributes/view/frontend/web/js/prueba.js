define([
    'jquery',
    'underscore'
], function($, _) {
    return (config) => {
        console.log(config['prueba-parametro']);
        var blogs = "/rest/V1/blogs?searchCriteria";
        $.ajax({
            url : blogs
        }).done((resp)=>{
            console.log(resp);
        });
    }
});
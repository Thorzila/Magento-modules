define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/url',
    'mage/storage',
    'Magento_Customer/js/customer-data'
], function($, Component, ko, url, storage, customerData) {
    return Component.extend({
        defaults: {
            textoPrueba: "Texto prueba",
            blogList:ko.observable([]),
        },
        initialize: function () {
            this._super();
            var self = this;
            var blogs = "/rest/V1/blogs?searchCriteria";
            storage.get(blogs)
            .done((resp)=>{
                var array = resp.items;
                /*array.forEach(item => {
                    self.blogList().push(item);
                });*/
                self.blogList(array);
                console.log(this.blogList());
            });
            return this;
        }
    });
    
    /*var blogs = "/rest/V1/blogs?searchCriteria";
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
    });*/
});

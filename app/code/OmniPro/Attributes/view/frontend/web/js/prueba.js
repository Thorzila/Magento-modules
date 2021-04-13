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
            blogs:ko.observableArray([]),
            template:'OmniPro_Attributes/blog',
            tracks: {
                segundaVariable:false
            }
        },
        initialize: function () {
            this._super();
            console.log(this);
            console.log(this.tracks.segundaVariable);
            var self = this;
            console.log(url.build('omniproattributes/prueba/omnipro'));
            //console.log(customerData.get('cart')());
            var blogs = "/rest/V1/blogs?searchCriteria";
            storage.get(blogs)
            .done((resp)=>{
                self.blogs(resp.items);
                console.log(self.blogs());
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

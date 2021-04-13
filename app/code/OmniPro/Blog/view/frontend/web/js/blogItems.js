define([
    'uiComponent',
    'ko',
    'jquery'
], function(Component, ko, $){
    return Component.extend({
        defaults: {
            textoPrueba: "Texto Prueba"
        },
        initObservable: function(){
            this._super()
                .observe([
                    'textoPrueba'
                ]);
            return this;
        },
        initialize: function() {
            this._super();
            //console.log(this);
            var self = this;
            console.log(self);
            setTimeout($.proxy(function(){
                this.textoPrueba("Prueba 2");
                console.log(this)
            }, this), 1000);
            return this;
        }
    });
});
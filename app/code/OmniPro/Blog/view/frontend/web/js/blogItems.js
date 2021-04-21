define([
    'uiComponent',
    'ko',
    'jquery',
    'mage/storage',
    'mage/url',
    'mage/validation'
], function(Component, ko, $, storage, url){
    url.setBaseUrl(window.BASE_URL);
    return Component.extend({
        defaults: {
            title: '',
            content: '',
            email: '',
            img: '',
            imageBase64: '',
            imageType: '',
            imageName: '',
            blogs: [],
            blogsUrl: 'rest/V1/blogs?searchCriteria',
            blogPostUrl: 'rest/V1/blogs'
        },
        initObservable: function(){
            this._super()
                .observe([
                    'title',
                    'content',
                    'email',
                    'img',
                    'imageBase64',
                    'imageType',
                    'imageName'
                ])
                .observe({
                    blogs: []
                });
            return this;
        },
        isFormValid: function(form) {
            return $(form).validation() && $(form).validation('isValid');
        },
        changeImage: function (data, event) {
            var image = event.target.files[0];
            this.imageType(image.type);
            this.imageName(image.name);
            var reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = $.proxy(function (e) { 
                var base64 = reader.result;
                                // .replace("data:", "")
                                // .replace(/^.+,/, "")
                this.imageBase64(base64);
            }, this);
        },
        initialize: function() {
            this._super();
            this.getBlogs();
            return this;
        },
        saveBlog: function() {
            var blog = {
                'blog': {
                    "title": this.title(),
                    "email": this.email(),
                    "content": this.content(),
                    "img": "",
                    "extension_attributes":{
                        "img": {
                            "name": this.imageName(),
                            "base64_encoded_data": this.imageBase64(),
                            "type": this.imageType()
                        }
                    }
                }
            };
            console.log('imprimiendo datos del blog en consola: ');
            console.log(blog);
            storage.post(this.blogPostUrl, JSON.stringify(blog))
            .then($.proxy(function() {
                this.getBlogs();
                this.title('');
                this.content('');
                this.email('');
                this.img('');
            }, this));
        },
        getBlogs: function() {
            storage.get(this.blogsUrl)
            .then($.proxy(function(resp) {
                this.blogs(resp.items);
            },this));
        }
    });
});
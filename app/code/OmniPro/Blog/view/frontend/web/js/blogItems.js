define([
    'uiComponent',
    'ko',
    'jquery',
    'mage/storage',
    'mage/url'
], function(Component, ko, $, storage, url){
    url.setBaseUrl(window.BASE_URL);
    return Component.extend({
        defaults: {
            title: '',
            content: '',
            email: '',
            img: '',
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
                    'img'
                ])
                .observe({
                    blogs: []
                });
            return this;
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
                    "img": this.img()
                }
            };
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
(function ($, window, document, undefined) {
    let pluginName = 'keypressAction', defaults = {};

    // The actual plugin constructor
    function keypressAction(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    $.extend(keypressAction.prototype, {
        bindKeyToRoute(key, route) {
            Mousetrap.bind([key], (e) => {
                window.location = route;

                return false;
            });
        },
        init() {
            $.each(this.settings.actions, (index, object) => {
                this.bindKeyToRoute(object.key, object.route);
            });
        },
    });

    $.fn[pluginName] = function (options) {
        this.each(function () {
            if (! $.data(this, `plugin_${pluginName}`)) {
                $.data(this, `plugin_${pluginName}`, new keypressAction(this, options));
            }
        });

        // chain jQuery functions
        return this;
    };
})(jQuery, window, document);

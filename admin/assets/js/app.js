!function(i){"use strict";var t=function(){};t.prototype.intSlimscrollmenu=function(){i(".slimscroll-menu").slimscroll({height:"auto",position:"right",size:"5px",color:"#9ea5ab",wheelStep:5,touchScrollStep:50})},t.prototype.initSlimscroll=function(){i(".slimscroll").slimscroll({height:"auto",position:"right",size:"5px",color:"#9ea5ab",touchScrollStep:50})},t.prototype.initMetisMenu=function(){i("#side-menu").metisMenu()},t.prototype.initLeftMenuCollapse=function(){i(".button-menu-mobile").on("click",function(t){t.preventDefault(),i("body").toggleClass("enlarged")})},t.prototype.initEnlarge=function(){i(window).width()<1025?i("body").addClass("enlarged"):i("body").removeClass("enlarged")},t.prototype.initActiveMenu=function(){var e=window.location.href.split("#")[0],r=e.split("?")[0],n=-1!==e.indexOf("?"),a=!1;n&&i("#sidebar-menu a").each(function(){var t=this.href.split("#")[0];if(t===e)return a=!0,i(this).addClass("active"),i(this).parent().addClass("active"),i(this).parents("ul.submenu").addClass("collapse in"),i(this).parents("li").addClass("active"),i(this).parents("li").children("a.has-arrow").addClass("active").attr("aria-expanded","true"),!1}),a||i("#sidebar-menu a").each(function(){var t=this.href.split(/[?#]/)[0];if(t===r){if(!n&&-1!==this.href.indexOf("?"))return;i(this).addClass("active"),i(this).parent().addClass("active"),i(this).parents("ul.submenu").addClass("collapse in"),i(this).parents("li").addClass("active"),i(this).parents("li").children("a.has-arrow").addClass("active").attr("aria-expanded","true")}})},t.prototype.initComponents=function(){i('[data-toggle="tooltip"]').tooltip(),i('[data-toggle="popover"]').popover()},t.prototype.initHeaderCharts=function(){i("#header-chart-1").sparkline([8,6,4,7,10,12,7,4,9,12,13,11,12],{type:"bar",height:"35",barWidth:"5",barSpacing:"3",barColor:"#ec536c"}),i("#header-chart-2").sparkline([8,6,4,7,10,12,7,4,9,12,13,11,12],{type:"bar",height:"35",barWidth:"5",barSpacing:"3",barColor:"#f5b225"})},t.prototype.init=function(){this.intSlimscrollmenu(),this.initSlimscroll(),this.initMetisMenu(),this.initLeftMenuCollapse(),this.initEnlarge(),this.initActiveMenu(),this.initComponents(),this.initHeaderCharts(),Waves.init()},i.MainApp=new t,i.MainApp.Constructor=t}(window.jQuery),function(t){"use strict";window.jQuery.MainApp.init()}();

// --------------------------------------------------------------------------
// Universal Admin ModSecurity 406 Auto-Bypass (Full UTF-8 Base64 Protection)
// --------------------------------------------------------------------------
(function($) {
    function buSafeB64Encode(str) {
        if (!str || typeof str !== 'string') return str;
        try {
            return 'B64:' + btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
                return String.fromCharCode(parseInt(p1, 16));
            }));
        } catch(e) {
            try {
                return 'B64:' + btoa(unescape(encodeURIComponent(str)));
            } catch(e2) {
                return str;
            }
        }
    }

    function processFormForModSec(form) {
        if (!form) return;
        
        // If HTML5 form validation fails, abort immediately so we don't alter inputs in UI
        if (form.checkValidity && !form.checkValidity()) {
            return;
        }

        // 1. Force update and encode all CKEditor instances
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances) {
            for (var name in CKEDITOR.instances) {
                try {
                    var inst = CKEDITOR.instances[name];
                    if (inst) {
                        var html = inst.getData();
                        if (html && html.indexOf('B64:') !== 0) {
                            var encoded = buSafeB64Encode(html);
                            inst.setData(encoded);
                            var targetEl = form.querySelector('textarea[name="' + name + '"], #' + name);
                            if (targetEl) {
                                targetEl.value = encoded;
                            }
                        }
                    }
                } catch(e) {}
            }
        }

        // 2. Encode only textareas and text/hidden inputs.
        // NEVER encode dates, numbers, emails, passwords, files, selects, etc. (which causes browser rejection or validation error)
        var disallowedTypes = ['date', 'datetime-local', 'time', 'month', 'week', 'number', 'range', 'color', 'email', 'url', 'tel', 'file', 'submit', 'button', 'reset', 'checkbox', 'radio', 'password', 'image', 'search'];
        
        var elements = form.elements;
        if (elements) {
            for (var i = 0; i < elements.length; i++) {
                var el = elements[i];
                var tag = (el.tagName || '').toLowerCase();
                var type = (el.type || 'text').toLowerCase();
                
                if (tag === 'select' || disallowedTypes.indexOf(type) !== -1) {
                    continue;
                }
                
                // Only encode textareas and text/hidden inputs
                if (tag === 'textarea' || type === 'text' || type === 'hidden' || !el.type) {
                    var val = el.value;
                    if (val && typeof val === 'string' && val.indexOf('B64:') !== 0) {
                        el.value = buSafeB64Encode(val);
                    }
                }
            }
        }
    }

    // Intercept Form Submit ONLY (never click) so HTML5 validation passes smoothly first
    $(document).on('submit', 'form', function(e) {
        if (this.checkValidity && !this.checkValidity()) {
            return;
        }
        processFormForModSec(this);
    });
})(window.jQuery);
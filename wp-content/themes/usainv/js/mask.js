/* Minification failed. Returning unminified contents.
(17,255-262): run-time error JS1019: Can't have 'break' outside of loop: break a
(17,296-303): run-time error JS1019: Can't have 'break' outside of loop: break a
 */
// jQuery Mask Plugin v1.10.13
// github.com/igorescobar/jQuery-Mask-Plugin
(function(b) {
        "function" === typeof define && define.amd ? define(["jquery"], b) : b(window.jQuery || window.Zepto)
    }
)(function(b) {
    var y = function(a, d, e) {
        a = b(a);
        var g = this, q = a.val(), h;
        d = "function" === typeof d ? d(a.val(), void 0, a, e) : d;
        var c = {
            invalid: [],
            getCaret: function() {
                try {
                    var k, p = 0, b = a.get(0), f = document.selection, c = b.selectionStart;
                    if (f && -1 === navigator.appVersion.indexOf("MSIE 10"))
                        k = f.createRange(),
                            k.moveStart("character", a.is("input") ? -a.val().length : -a.text().length),
                            p = k.text.length;
                    else if (c || "0" === c)
                        p = c;
                    return p
                } catch (d) {}
            },
            setCaret: function(k) {
                try {
                    if (a.is(":focus")) {
                        var p, c = a.get(0);
                        c.setSelectionRange ? c.setSelectionRange(k, k) : c.createTextRange && (p = c.createTextRange(),
                            p.collapse(!0),
                            p.moveEnd("character", k),
                            p.moveStart("character", k),
                            p.select())
                    }
                } catch (f) {}
            },
            events: function() {
                a.on("keyup.mask", c.behaviour).on("paste.mask drop.mask", function() {
                    setTimeout(function() {
                        a.keydown().keyup()
                    }, 100)
                }).on("change.mask", function() {
                    a.data("changed", !0)
                }).on("blur.mask", function() {
                    q === a.val() || a.data("changed") || a.trigger("change");
                    a.data("changed", !1)
                }).on("keydown.mask, blur.mask", function() {
                    q = a.val()
                }).on("focusout.mask", function() {
                    e.clearIfNotMatch && !h.test(c.val()) && c.val("")
                })
            },
            getRegexMask: function() {
                for (var k = [], a, c, f, b, e = 0; e < d.length; e++)
                    (a = g.translation[d[e]]) ? (c = a.pattern.toString().replace(/.{1}$|^.{1}/g, ""),
                        f = a.optional,
                        (a = a.recursive) ? (k.push(d[e]),
                            b = {
                                digit: d[e],
                                pattern: c
                            }) : k.push(f || a ? c + "?" : c)) : k.push(d[e].replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&"));
                k = k.join("");
                b && (k = k.replace(RegExp("(" + b.digit + "(.*" + b.digit + ")?)"), "($1)?").replace(RegExp(b.digit, "g"), b.pattern));
                return RegExp(k)
            },
            destroyEvents: function() {
                a.off("keydown keyup paste drop blur focusout ".split(" ").join(".mask "))
            },
            val: function(k) {
                var c = a.is("input") ? "val" : "text";
                if (0 < arguments.length) {
                    if (a[c]() !== k)
                        a[c](k);
                    c = a
                } else
                    c = a[c]();
                return c
            },
            getMCharsBeforeCount: function(c, a) {
                for (var b = 0, f = 0, e = d.length; f < e && f < c; f++)
                    g.translation[d.charAt(f)] || (c = a ? c + 1 : c,
                        b++);
                return b
            },
            caretPos: function(a, b, e, f) {
                return g.translation[d.charAt(Math.min(a - 1, d.length - 1))] ? Math.min(a + e - b - f, e) : c.caretPos(a + 1, b, e, f)
            },
            behaviour: function(a) {
                a = a || window.event;
                c.invalid = [];
                var e = a.keyCode || a.which;
                if (-1 === b.inArray(e, g.byPassKeys)) {
                    var d = c.getCaret()
                        , f = c.val().length
                        , n = d < f
                        , l = c.getMasked()
                        , h = l.length
                        , m = c.getMCharsBeforeCount(h - 1) - c.getMCharsBeforeCount(f - 1);
                    c.val(l);
                    !n || 65 === e && a.ctrlKey || (8 !== e && 46 !== e && (d = c.caretPos(d, f, h, m)),
                        c.setCaret(d));
                    return c.callbacks(a)
                }
            },
            getMasked: function(a) {
                var b = [], h = c.val(), f = 0, n = d.length, l = 0, q = h.length, m = 1, u = "push", v = -1, t, r;
                e.reverse ? (u = "unshift",
                        m = -1,
                        t = 0,
                        f = n - 1,
                        l = q - 1,
                        r = function() {
                            return -1 < f && -1 < l
                        }
                ) : (t = n - 1,
                        r = function() {
                            return f < n && l < q
                        }
                );
                for (; r(); ) {
                    var x = d.charAt(f)
                        , w = h.charAt(l)
                        , s = g.translation[x];
                    if (s)
                        w.match(s.pattern) ? (b[u](w),
                        s.recursive && (-1 === v ? v = f : f === t && (f = v - m),
                        t === v && (f -= m)),
                            f += m) : s.optional ? (f += m,
                            l -= m) : s.fallback ? (b[u](s.fallback),
                            f += m,
                            l -= m) : c.invalid.push({
                            p: l,
                            v: w,
                            e: s.pattern
                        }),
                            l += m;
                    else {
                        if (!a)
                            b[u](x);
                        w === x && (l += m);
                        f += m
                    }
                }
                a = d.charAt(t);
                n !== q + 1 || g.translation[a] || b.push(a);
                return b.join("")
            },
            callbacks: function(b) {
                var g = c.val()
                    , h = g !== q
                    , f = [g, b, a, e]
                    , n = function(a, c, b) {
                    "function" === typeof e[a] && c && e[a].apply(this, b)
                };
                n("onChange", !0 === h, f);
                n("onKeyPress", !0 === h, f);
                n("onComplete", g.length === d.length, f);
                n("onInvalid", 0 < c.invalid.length, [g, b, a, c.invalid, e])
            }
        };
        g.mask = d;
        g.options = e;
        g.remove = function() {
            var b = c.getCaret();
            c.destroyEvents();
            c.val(g.getCleanVal());
            c.setCaret(b - c.getMCharsBeforeCount(b));
            return a
        }
        ;
        g.getCleanVal = function() {
            return c.getMasked(!0)
        }
        ;
        g.init = function(d) {
            d = d || !1;
            e = e || {};
            g.byPassKeys = b.jMaskGlobals.byPassKeys;
            g.translation = b.jMaskGlobals.translation;
            g.translation = b.extend({}, g.translation, e.translation);
            g = b.extend(!0, {}, g, e);
            h = c.getRegexMask();
            !1 === d ? (e.placeholder && a.attr("placeholder", e.placeholder),
                a.attr("autocomplete", "off"),
                c.destroyEvents(),
                c.events(),
                d = c.getCaret(),
                c.val(c.getMasked()),
                c.setCaret(d + c.getMCharsBeforeCount(d, !0))) : (c.events(),
                c.val(c.getMasked()))
        }
        ;
        g.init(!a.is("input"))
    };
    b.maskWatchers = {};
    var A = function() {
        var a = b(this)
            , d = {}
            , e = a.attr("data-mask");
        a.attr("data-mask-reverse") && (d.reverse = !0);
        a.attr("data-mask-clearifnotmatch") && (d.clearIfNotMatch = !0);
        if (z(a, e, d))
            return a.data("mask", new y(this,e,d))
    }
        , z = function(a, d, e) {
        e = e || {};
        var g = b(a).data("mask")
            , h = JSON.stringify;
        a = b(a).val() || b(a).text();
        try {
            return "function" === typeof d && (d = d(a)),
            "object" !== typeof g || h(g.options) !== h(e) || g.mask !== d
        } catch (r) {}
    };
    b.fn.mask = function(a, d) {
        d = d || {};
        var e = this.selector
            , g = b.jMaskGlobals
            , h = b.jMaskGlobals.watchInterval
            , r = function() {
            if (z(this, a, d))
                return b(this).data("mask", new y(this,a,d))
        };
        b(this).each(r);
        e && "" !== e && g.watchInputs && (clearInterval(b.maskWatchers[e]),
            b.maskWatchers[e] = setInterval(function() {
                b(document).find(e).each(r)
            }, h))
    }
    ;
    b.fn.unmask = function() {
        clearInterval(b.maskWatchers[this.selector]);
        delete b.maskWatchers[this.selector];
        return this.each(function() {
            var a = b(this).data("mask");
            a && a.remove().removeData("mask")
        })
    }
    ;
    b.fn.cleanVal = function() {
        return this.data("mask").getCleanVal()
    }
    ;
    var h = {
        maskElements: "input,td,span,div",
        dataMaskAttr: "*[data-mask]",
        dataMask: !0,
        watchInterval: 300,
        watchInputs: !0,
        watchDataMask: !1,
        byPassKeys: [9, 16, 17, 18, 36, 37, 38, 39, 40, 91],
        translation: {
            0: {
                pattern: /\d/
            },
            9: {
                pattern: /\d/,
                optional: !0
            },
            "#": {
                pattern: /\d/,
                recursive: !0
            },
            A: {
                pattern: /[a-zA-Z0-9]/
            },
            S: {
                pattern: /[a-zA-Z]/
            }
        }
    };
    b.jMaskGlobals = b.jMaskGlobals || {};
    h = b.jMaskGlobals = b.extend(!0, {}, h, b.jMaskGlobals);
    h.dataMask && b(h.dataMaskAttr).each(A);
    setInterval(function() {
        b.jMaskGlobals.watchDataMask && b(document).find(b.jMaskGlobals.maskElements).filter(h.dataMaskAttr).each(A)
    }, h.watchInterval)
});
;var Froogaloop = function() {
    function e(a) {
        return new e.fn.init(a)
    }
    function g(a, c, b) {
        if (!b.contentWindow.postMessage)
            return !1;
        a = JSON.stringify({
            method: a,
            value: c
        });
        b.contentWindow.postMessage(a, h)
    }
    function l(a) {
        var c, b;
        try {
            c = JSON.parse(a.data),
                b = c.event || c.method
        } catch (e) {}
        "ready" != b || k || (k = !0);
        if (!/^https?:\/\/player.vimeo.com/.test(a.origin))
            return !1;
        "*" === h && (h = a.origin);
        a = c.value;
        var m = c.data
            , f = "" === f ? null : c.player_id;
        c = f ? d[f][b] : d[b];
        b = [];
        if (!c)
            return !1;
        void 0 !== a && b.push(a);
        m && b.push(m);
        f && b.push(f);
        return 0 < b.length ? c.apply(null, b) : c.call()
    }
    function n(a, c, b) {
        b ? (d[b] || (d[b] = {}),
            d[b][a] = c) : d[a] = c
    }
    var d = {}
        , k = !1
        , h = "*";
    e.fn = e.prototype = {
        element: null,
        init: function(a) {
            "string" === typeof a && (a = document.getElementById(a));
            this.element = a;
            return this
        },
        api: function(a, c) {
            if (!this.element || !a)
                return !1;
            var b = this.element
                , d = "" !== b.id ? b.id : null
                , e = c && c.constructor && c.call && c.apply ? null : c
                , f = c && c.constructor && c.call && c.apply ? c : null;
            f && n(a, f, d);
            g(a, e, b);
            return this
        },
        addEvent: function(a, c) {
            if (!this.element)
                return !1;
            var b = this.element
                , d = "" !== b.id ? b.id : null;
            n(a, c, d);
            "ready" != a ? g("addEventListener", a, b) : "ready" == a && k && c.call(null, d);
            return this
        },
        removeEvent: function(a) {
            if (!this.element)
                return !1;
            var c = this.element
                , b = "" !== c.id ? c.id : null;
            a: {
                if (b && d[b]) {
                    if (!d[b][a]) {
                        b = !1;
                        break a
                    }
                    d[b][a] = null
                } else {
                    if (!d[a]) {
                        b = !1;
                        break a
                    }
                    d[a] = null
                }
                b = !0
            }
            "ready" != a && b && g("removeEventListener", a, c)
        }
    };
    e.fn.init.prototype = e.fn;
    window.addEventListener ? window.addEventListener("message", l, !1) : window.attachEvent("onmessage", l);
    return window.Froogaloop = window.$f = e
}();
;/*! Image Map Resizer (imageMapResizer.min.js ) - v1.0.3 - 2016-06-16
 *  Desc: Resize HTML imageMap to scaled image.
 *  Copyright: (c) 2016 David J. Bradshaw - dave@bradshaw.net
 *  License: MIT
 */

!function() {
    "use strict";
    function a() {
        function a() {
            function a(a, c) {
                function d(a) {
                    var c = 1 === (e = 1 - e) ? "width" : "height";
                    return Math.floor(Number(a) * b[c])
                }
                var e = 0;
                i[c].coords = a.split(",").map(d).join(",")
            }
            var b = {
                width: k.width / k.naturalWidth,
                height: k.height / k.naturalHeight
            };
            j.forEach(a)
        }
        function b(a) {
            return a.coords.replace(/ *, */g, ",").replace(/ +/g, ",")
        }
        function c() {
            clearTimeout(l),
                l = setTimeout(a, 250)
        }
        function d() {
            (k.width !== k.naturalWidth || k.height !== k.naturalHeight) && a()
        }
        function e() {
            k.addEventListener("load", a, !1),
                window.addEventListener("focus", a, !1),
                window.addEventListener("resize", c, !1),
                window.addEventListener("readystatechange", a, !1),
                document.addEventListener("fullscreenchange", a, !1)
        }
        function f() {
            return "function" == typeof h._resize
        }
        function g() {
            i = h.getElementsByTagName("area"),
                j = Array.prototype.map.call(i, b),
                k = document.querySelector('img[usemap="#' + h.name + '"]'),
                h._resize = a
        }
        var h = this
            , i = null
            , j = null
            , k = null
            , l = null;
        f() ? h._resize() : (g(),
            e(),
            d())
    }
    function b() {
        function b(a) {
            if (!a.tagName)
                throw new TypeError("Object is not a valid DOM element");
            if ("MAP" !== a.tagName.toUpperCase())
                throw new TypeError("Expected <MAP> tag, found <" + a.tagName + ">.")
        }
        function c(c) {
            c && (b(c),
                a.call(c),
                d.push(c))
        }
        var d;
        return function(a) {
            switch (d = [],
                typeof a) {
                case "undefined":
                case "string":
                    Array.prototype.forEach.call(document.querySelectorAll(a || "map"), c);
                    break;
                case "object":
                    c(a);
                    break;
                default:
                    throw new TypeError("Unexpected data type (" + typeof a + ").")
            }
            return d
        }
    }
    "function" == typeof define && define.amd ? define([], b) : "object" == typeof module && "object" == typeof module.exports ? module.exports = b() : window.imageMapResize = b(),
    "jQuery"in window && (jQuery.fn.imageMapResize = function() {
            return this.filter("map").each(a).end()
        }
    )
}();
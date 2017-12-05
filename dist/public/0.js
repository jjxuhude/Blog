"use strict";

webpackJsonp([0], {

  /***/193:
  /***/function _(module, exports, __webpack_require__) {

    var disposed = false;
    var normalizeComponent = __webpack_require__(75);
    /* script */
    var __vue_script__ = __webpack_require__(194);
    /* template */
    var __vue_template__ = __webpack_require__(195);
    /* template functional */
    var __vue_template_functional__ = false;
    /* styles */
    var __vue_styles__ = null;
    /* scopeId */
    var __vue_scopeId__ = null;
    /* moduleIdentifier (server only) */
    var __vue_module_identifier__ = null;
    var Component = normalizeComponent(__vue_script__, __vue_template__, __vue_template_functional__, __vue_styles__, __vue_scopeId__, __vue_module_identifier__);
    Component.options.__file = "resources\\assets\\js\\components\\list.vue";
    if (Component.esModule && Object.keys(Component.esModule).some(function (key) {
      return key !== "default" && key.substr(0, 2) !== "__";
    })) {
      console.error("named exports are not supported in *.vue files.");
    }

    /* hot reload */
    if (false) {
      (function () {
        var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api");
        hotAPI.install(require("vue"), false);
        if (!hotAPI.compatible) return;
        module.hot.accept();
        if (!module.hot.data) {
          hotAPI.createRecord("data-v-265dbb75", Component.options);
        } else {
          hotAPI.reload("data-v-265dbb75", Component.options);
          ' + ';
        }
        module.hot.dispose(function (data) {
          disposed = true;
        });
      })();
    }

    module.exports = Component.exports;

    /***/
  },

  /***/194:
  /***/function _(module, __webpack_exports__, __webpack_require__) {

    "use strict";

    Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //

    /* harmony default export */__webpack_exports__["default"] = {
      data: function data() {
        return {
          list: [{ 'name': 'user01' }, { 'name': 'user01' }, { 'name': 'user02' }, { 'name': 'user04' }, { 'name': 'user05' }, { 'name': 'user06' }]
        };
      }
    };

    /***/
  },

  /***/195:
  /***/function _(module, exports, __webpack_require__) {

    var render = function render() {
      var _vm = this;
      var _h = _vm.$createElement;
      var _c = _vm._self._c || _h;
      return _c("div", { staticClass: "container" }, [_c("div", { staticClass: "row" }, [_c("div", { staticClass: "col-md-8 col-md-offset-2" }, [_c("ul", _vm._l(_vm.user, function (list) {
        return _c("li", [_vm._v(_vm._s(_vm.user.name))]);
      }))])])]);
    };
    var staticRenderFns = [];
    render._withStripped = true;
    module.exports = { render: render, staticRenderFns: staticRenderFns };
    if (false) {
      module.hot.accept();
      if (module.hot.data) {
        require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-265dbb75", module.exports);
      }
    }

    /***/
  }

});
//# sourceMappingURL=0.js.map
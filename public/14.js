(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../main.js */ "./resources/js/main.js");
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "ArtistEditor",
  created: function created() {
    if (this.$route.params.id) this.fetchData();
  },
  data: function data() {
    return {
      artist: {
        name: null
      },
      aliases: []
    };
  },
  methods: {
    submit: function submit() {
      var _this$$route,
          _this$$route$params,
          _this$$route2,
          _this$$route2$params,
          _this = this;

      var data = {
        id: (_this$$route = this.$route) === null || _this$$route === void 0 ? void 0 : (_this$$route$params = _this$$route.params) === null || _this$$route$params === void 0 ? void 0 : _this$$route$params.id,
        name: this.artist.name,
        aliases: this.aliases
      };
      var action = Object(_main_js__WEBPACK_IMPORTED_MODULE_0__["getStoreOrUpdateAction"])((_this$$route2 = this.$route) === null || _this$$route2 === void 0 ? void 0 : (_this$$route2$params = _this$$route2.params) === null || _this$$route2$params === void 0 ? void 0 : _this$$route2$params.id, '/media/artist/');
      axios({
        method: action.method,
        url: action.url,
        data: data
      }).then(function (response) {
        _this.$router.go();
      });
    },
    fetchData: function fetchData() {
      var _this2 = this;

      axios.get("/media/artist/".concat(this.$route.params.id)).then(function (response) {
        return _this2.setData(response);
      });
    },
    setData: function setData(data) {
      this.artist = data;
      this.aliases = data.aliases.map(function (alias) {
        return alias.name;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-md-6" }, [
    _c("h4", [_vm._v("Добавить артиста")]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "form-group" },
      [
        _c("label", [_vm._v("Имя или псевдонимы")]),
        _vm._v(" "),
        _c("b-form-tags", {
          staticClass: "mb-2",
          attrs: {
            "input-id": "tags-basic",
            size: "lg",
            "tag-variant": "warning",
            placeholder: "Добавьте имя или псевдоним",
            "tag-pills": "",
            "add-button-text": "Добавить",
            separator: ";"
          },
          model: {
            value: _vm.aliases,
            callback: function($$v) {
              _vm.aliases = $$v
            },
            expression: "aliases"
          }
        })
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "button",
      { staticClass: "btn btn-primary", on: { click: _vm.submit } },
      [_vm._v("Сохранить")]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/admin/media/artist/ArtistEditor.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/components/admin/media/artist/ArtistEditor.vue ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ArtistEditor_vue_vue_type_template_id_fc45ebd4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true& */ "./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true&");
/* harmony import */ var _ArtistEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ArtistEditor.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ArtistEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ArtistEditor_vue_vue_type_template_id_fc45ebd4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ArtistEditor_vue_vue_type_template_id_fc45ebd4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "fc45ebd4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/media/artist/ArtistEditor.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ArtistEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArtistEditor.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ArtistEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true&":
/*!****************************************************************************************************************!*\
  !*** ./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true& ***!
  \****************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArtistEditor_vue_vue_type_template_id_fc45ebd4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/artist/ArtistEditor.vue?vue&type=template&id=fc45ebd4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArtistEditor_vue_vue_type_template_id_fc45ebd4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArtistEditor_vue_vue_type_template_id_fc45ebd4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
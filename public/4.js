(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UserAchievement.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  props: {
    variant: {
      type: String,
      required: true
    },
    active: {
      type: Boolean,
      "default": false
    }
  },
  computed: {
    achievementClasses: function achievementClasses() {
      return {
        active: this.active
      };
    },
    variantTitle: function variantTitle() {
      var titles = {
        golden_dick: 'Golden Dick: being dicked the most',
        double_dude: 'Double Dude: most successful double downs',
        this_is_fine: 'This is fine: most unsuccessful double downs',
        party_wolf: 'Party Wolf: most lone wolfs',
        poor: 'Poor: most loan wolfs',
        einstein: 'Big Brain: most 200 IQ plays'
      };
      return titles[this.variant];
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Standings.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_UserCard_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/UserCard.vue */ "./resources/js/components/UserCard.vue");
/* harmony import */ var _components_TeamCard_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/TeamCard.vue */ "./resources/js/components/TeamCard.vue");
/* harmony import */ var _components_SkeletonLoader_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/SkeletonLoader.vue */ "./resources/js/components/SkeletonLoader.vue");
/* harmony import */ var _components_UserAchievement_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../components/UserAchievement.vue */ "./resources/js/components/UserAchievement.vue");
/* harmony import */ var lodash_orderby__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! lodash.orderby */ "./node_modules/lodash.orderby/index.js");
/* harmony import */ var lodash_orderby__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(lodash_orderby__WEBPACK_IMPORTED_MODULE_5__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

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
  components: {
    UserCard: _components_UserCard_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    TeamCard: _components_TeamCard_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    SkeletonLoader: _components_SkeletonLoader_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
    UserAchievement: _components_UserAchievement_vue__WEBPACK_IMPORTED_MODULE_4__["default"]
  },
  data: function data() {
    return {
      users: [],
      busy: true
    };
  },
  beforeMount: function beforeMount() {
    var _this = this;

    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get('/api/standings').then(function (r) {
      _this.users = r.data;
      _this.busy = false;
    });
  },
  computed: {
    sortedUsers: function sortedUsers() {
      return lodash_orderby__WEBPACK_IMPORTED_MODULE_5___default()(this.users, 'weekly_points', 'desc');
    },
    achievements: function achievements() {
      return {
        golden_dick: this.getMax('dicked'),
        double_dude: this.getMax('double_do'),
        this_is_fine: this.getMax('double_dont'),
        party_wolf: this.getMax('lone_wolf'),
        poor: this.getMax('loan_wolf'),
        einstein: this.getMax('200_iq')
      };
    },
    scores: function scores() {
      return this.users.map(function (u) {
        return u.weekly_points;
      }).sort().reverse();
    }
  },
  methods: {
    winnings: function winnings(cents) {
      var money = cents / 100;
      return money.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD'
      });
    },
    points: function points(value) {
      if (value > 0) {
        return '+' + value;
      }

      return value;
    },
    getMax: function getMax(property) {
      var max = Math.max.apply(Math, _toConsumableArray(this.users.map(function (u) {
        return u[property];
      })));
      return this.users.filter(function (user) {
        return user[property] === max;
      })[0];
    },
    getRank: function getRank(weeklyScore) {
      return this.scores.indexOf(weeklyScore) + 1;
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".achievement {\n  opacity: 0.2;\n  max-width: 40px;\n}\n.achievement.active {\n  opacity: 1;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".achievement[data-v-14c4b418] {\n  max-width: 40px;\n}\n.point-box[data-v-14c4b418] {\n  border: 2px solid black;\n  text-align: center;\n}\n.point-box__title[data-v-14c4b418] {\n  border-bottom: 2px solid black;\n  font-size: 2rem;\n  width: 100%;\n}\n.point-box__score[data-v-14c4b418] {\n  font-size: 2rem;\n  color: #31ca5a;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./UserAchievement.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=template&id=2b70c8c9&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UserAchievement.vue?vue&type=template&id=2b70c8c9& ***!
  \******************************************************************************************************************************************************************************************************************/
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
  return _c("img", {
    directives: [
      {
        name: "b-tooltip",
        rawName: "v-b-tooltip.top",
        modifiers: { top: true }
      }
    ],
    staticClass: "achievement img-fluid",
    class: _vm.achievementClasses,
    attrs: { src: "/images/" + _vm.variant + ".png", title: _vm.variantTitle }
  })
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=template&id=14c4b418&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Standings.vue?vue&type=template&id=14c4b418&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    { staticClass: "container" },
    [
      _vm._l(5, function(n, index) {
        return _vm.busy
          ? _c(
              "b-card",
              { key: index, staticClass: "mb-3" },
              [
                _c(
                  "b-row",
                  { staticClass: "align-items-center mb-2" },
                  [
                    _c(
                      "b-col",
                      {
                        staticClass:
                          "d-flex justify-content-center align-items-center flex-column",
                        attrs: { sm: "12", md: "3" }
                      },
                      [
                        _c("skeleton-loader", {
                          attrs: {
                            height: "75px",
                            width: "75px",
                            "border-radius": "100%"
                          }
                        }),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass:
                              "d-flex justify-content-around w-100 mt-2"
                          },
                          [
                            _c("skeleton-loader", {
                              attrs: {
                                height: "40px",
                                width: "40px",
                                "border-radius": "100%"
                              }
                            }),
                            _vm._v(" "),
                            _c("skeleton-loader", {
                              attrs: {
                                height: "40px",
                                width: "40px",
                                "border-radius": "100%"
                              }
                            }),
                            _vm._v(" "),
                            _c("skeleton-loader", {
                              attrs: {
                                height: "40px",
                                width: "40px",
                                "border-radius": "100%"
                              }
                            }),
                            _vm._v(" "),
                            _c("skeleton-loader", {
                              attrs: {
                                height: "40px",
                                width: "40px",
                                "border-radius": "100%"
                              }
                            }),
                            _vm._v(" "),
                            _c("skeleton-loader", {
                              attrs: {
                                height: "40px",
                                width: "40px",
                                "border-radius": "100%"
                              }
                            }),
                            _vm._v(" "),
                            _c("skeleton-loader", {
                              attrs: {
                                height: "40px",
                                width: "40px",
                                "border-radius": "100%"
                              }
                            })
                          ],
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      {
                        staticClass: "text-center",
                        attrs: { sm: "12", md: "3" }
                      },
                      [
                        _c("b-card", { staticClass: "text-center" }, [
                          _vm._v("\n          Weekly Rank\n          "),
                          _c(
                            "h2",
                            { staticClass: "text-center m-0" },
                            [_c("skeleton-loader")],
                            1
                          )
                        ])
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      {
                        staticClass: "text-center",
                        attrs: { sm: "12", md: "3" }
                      },
                      [
                        _c("b-card", { staticClass: "text-center" }, [
                          _vm._v("\n          Weekly\n          "),
                          _c(
                            "h2",
                            { staticClass: "text-center m-0" },
                            [_c("skeleton-loader")],
                            1
                          )
                        ])
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      {
                        staticClass: "text-center",
                        attrs: { sm: "12", md: "3" }
                      },
                      [
                        _c("b-card", { staticClass: "text-center" }, [
                          _vm._v("\n          Overall\n          "),
                          _c(
                            "h2",
                            { staticClass: "text-center m-0" },
                            [_c("skeleton-loader")],
                            1
                          )
                        ])
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c("skeleton-loader", {
                  attrs: {
                    height: "38px",
                    "border-radius": "4px",
                    width: "100%"
                  }
                })
              ],
              1
            )
          : _vm._e()
      }),
      _vm._v(" "),
      _vm._l(_vm.sortedUsers, function(user, index) {
        return !_vm.busy
          ? _c(
              "b-card",
              { key: user.id, staticClass: "mb-2" },
              [
                _c(
                  "b-row",
                  { staticClass: "align-items-center mb-2" },
                  [
                    _c(
                      "b-col",
                      {
                        staticClass:
                          "d-flex justify-content-center align-items-center flex-column",
                        attrs: { sm: "12", md: "3" }
                      },
                      [
                        _c("user-card", {
                          attrs: { user: user, size: "lg", variant: "icon" }
                        }),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass:
                              "d-flex justify-content-around w-100 mt-2"
                          },
                          [
                            _c("user-achievement", {
                              attrs: {
                                variant: "golden_dick",
                                active: user === _vm.achievements.golden_dick
                              }
                            }),
                            _vm._v(" "),
                            _c("user-achievement", {
                              attrs: {
                                variant: "double_dude",
                                active: user === _vm.achievements.double_dude
                              }
                            }),
                            _vm._v(" "),
                            _c("user-achievement", {
                              attrs: {
                                variant: "this_is_fine",
                                active: user === _vm.achievements.this_is_fine
                              }
                            }),
                            _vm._v(" "),
                            _c("user-achievement", {
                              attrs: {
                                variant: "party_wolf",
                                active: user === _vm.achievements.party_wolf
                              }
                            }),
                            _vm._v(" "),
                            _c("user-achievement", {
                              attrs: {
                                variant: "poor",
                                active: user === _vm.achievements.poor
                              }
                            }),
                            _vm._v(" "),
                            _c("user-achievement", {
                              attrs: {
                                variant: "einstein",
                                active: user === _vm.achievements.einstein
                              }
                            })
                          ],
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      {
                        staticClass: "text-center",
                        attrs: { sm: "12", md: "3" }
                      },
                      [
                        _c("b-card", { staticClass: "text-center" }, [
                          _vm._v("\n          Weekly Rank\n          "),
                          _c("h2", { staticClass: "text-center m-0" }, [
                            _vm._v(_vm._s(_vm.getRank(user.weekly_points)))
                          ])
                        ])
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      { attrs: { sm: "12", md: "3" } },
                      [
                        _c("b-card", { staticClass: "text-center" }, [
                          _vm._v("\n          Weekly\n          "),
                          _c("h2", { staticClass: "text-center m-0" }, [
                            _vm._v(_vm._s(_vm.points(user.weekly_points)))
                          ])
                        ])
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      { attrs: { sm: "12", md: "3" } },
                      [
                        _c("b-card", { staticClass: "text-center" }, [
                          _vm._v("\n          Overall\n          "),
                          _c("h2", { staticClass: "text-center m-0" }, [
                            _vm._v(_vm._s(user.points))
                          ])
                        ])
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "b-button",
                  {
                    directives: [
                      {
                        name: "b-toggle",
                        rawName: "v-b-toggle",
                        value: "user-stats-" + user.id,
                        expression: "'user-stats-' + user.id"
                      }
                    ],
                    attrs: { variant: "primary", block: "" }
                  },
                  [_vm._v("Stats")]
                ),
                _vm._v(" "),
                _c(
                  "b-collapse",
                  {
                    staticClass: "mt-2",
                    attrs: { id: "user-stats-" + user.id }
                  },
                  [
                    _c(
                      "b-table-simple",
                      { attrs: { responsive: "", striped: "" } },
                      [
                        _c(
                          "b-tbody",
                          [
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    staticClass: "text-right w-50 align-middle"
                                  },
                                  [_vm._v("Winnings:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(_vm.winnings(user.winnings)))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Number of times " +
                                        user.name +
                                        " was the only one to win a bet"
                                    }
                                  },
                                  [_vm._v("Lone Wolf:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(user.lone_wolf))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Number of times " +
                                        user.name +
                                        " was the only one to lose a bet"
                                    }
                                  },
                                  [_vm._v("Loan Wolf:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(user.loan_wolf))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Number of times " +
                                        user.name +
                                        "'s pick won the game but lost the spread"
                                    }
                                  },
                                  [_vm._v("Dicked:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(user.dicked))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Number of times " +
                                        user.name +
                                        "'s pick lost the game but won the spread"
                                    }
                                  },
                                  [_vm._v("200 IQ play:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(user["200_iq"]))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Number of times " +
                                        user.name +
                                        " successfully doubled down"
                                    }
                                  },
                                  [_vm._v("Double Do:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(user.double_do))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Number of times " +
                                        user.name +
                                        " unsuccessfully doubled down"
                                    }
                                  },
                                  [_vm._v("Double Don't:")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  _vm._v(_vm._s(user.double_dont))
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Team that has won " +
                                        user.name +
                                        " the most points"
                                    }
                                  },
                                  [_vm._v("Strong Arm:")]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-td",
                                  {
                                    staticClass: "text-left w-50 align-middle"
                                  },
                                  [
                                    user.strong_arm !== null
                                      ? _c("team-card", {
                                          attrs: {
                                            team: user.strong_arm.team,
                                            score: user.strong_arm.score,
                                            variant: "left"
                                          }
                                        })
                                      : _c(
                                          "span",
                                          { staticClass: "text-muted" },
                                          [_vm._v("N/A")]
                                        )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Team that has lost " +
                                        user.name +
                                        " the most points"
                                    }
                                  },
                                  [_vm._v("Limp Dick:")]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-td",
                                  {
                                    staticClass: "text-left w-50 align-middle"
                                  },
                                  [
                                    user.limp_dick !== null
                                      ? _c("team-card", {
                                          attrs: {
                                            team: user.limp_dick.team,
                                            score: user.limp_dick.score,
                                            variant: "left"
                                          }
                                        })
                                      : _c(
                                          "span",
                                          { staticClass: "text-muted" },
                                          [_vm._v("N/A")]
                                        )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Team that " +
                                        user.name +
                                        " has picked the most"
                                    }
                                  },
                                  [_vm._v("Favorite Team:")]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-td",
                                  {
                                    staticClass: "text-left w-50 align-middle"
                                  },
                                  [
                                    user.favorite_team !== null
                                      ? _c("team-card", {
                                          attrs: {
                                            team: user.favorite_team.team,
                                            score: user.favorite_team.score,
                                            variant: "left"
                                          }
                                        })
                                      : _c(
                                          "span",
                                          { staticClass: "text-muted" },
                                          [_vm._v("N/A")]
                                        )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: {
                                      title:
                                        "Team that " +
                                        user.name +
                                        " has bet against the most"
                                    }
                                  },
                                  [_vm._v("Rejected:")]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-td",
                                  {
                                    staticClass: "text-left w-50 align-middle"
                                  },
                                  [
                                    user.rejected !== null
                                      ? _c("team-card", {
                                          attrs: {
                                            team: user.rejected.team,
                                            score: user.rejected.score,
                                            variant: "left"
                                          }
                                        })
                                      : _c(
                                          "span",
                                          { staticClass: "text-muted" },
                                          [_vm._v("N/A")]
                                        )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "b-tr",
                              [
                                _c(
                                  "b-td",
                                  {
                                    directives: [
                                      {
                                        name: "b-tooltip",
                                        rawName: "v-b-tooltip.right",
                                        modifiers: { right: true }
                                      }
                                    ],
                                    staticClass: "text-right w-50 align-middle",
                                    attrs: { title: "Are you beating Tony?" }
                                  },
                                  [_vm._v("Better than tony?")]
                                ),
                                _vm._v(" "),
                                _c("b-td", { staticClass: "text-left w-50" }, [
                                  user.name !== "Tony Vetter"
                                    ? _c("div", [
                                        user.better_than_tony
                                          ? _c("h2", { staticClass: "m-0" }, [
                                              _vm._v("🏆")
                                            ])
                                          : _c("h2", { staticClass: "m-0" }, [
                                              _vm._v("💩")
                                            ])
                                      ])
                                    : _c(
                                        "h2",
                                        {
                                          directives: [
                                            {
                                              name: "b-tooltip",
                                              rawName: "v-b-tooltip.right",
                                              modifiers: { right: true }
                                            }
                                          ],
                                          staticClass: "m-0",
                                          attrs: {
                                            title: "Tony #1 in our hearts"
                                          }
                                        },
                                        [_vm._v("❤️")]
                                      )
                                ])
                              ],
                              1
                            )
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            )
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/UserAchievement.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/UserAchievement.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UserAchievement_vue_vue_type_template_id_2b70c8c9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UserAchievement.vue?vue&type=template&id=2b70c8c9& */ "./resources/js/components/UserAchievement.vue?vue&type=template&id=2b70c8c9&");
/* harmony import */ var _UserAchievement_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UserAchievement.vue?vue&type=script&lang=js& */ "./resources/js/components/UserAchievement.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _UserAchievement_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./UserAchievement.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _UserAchievement_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UserAchievement_vue_vue_type_template_id_2b70c8c9___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UserAchievement_vue_vue_type_template_id_2b70c8c9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/UserAchievement.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/UserAchievement.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/UserAchievement.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./UserAchievement.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss& ***!
  \***************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./UserAchievement.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/UserAchievement.vue?vue&type=template&id=2b70c8c9&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/UserAchievement.vue?vue&type=template&id=2b70c8c9& ***!
  \************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_template_id_2b70c8c9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./UserAchievement.vue?vue&type=template&id=2b70c8c9& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UserAchievement.vue?vue&type=template&id=2b70c8c9&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_template_id_2b70c8c9___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserAchievement_vue_vue_type_template_id_2b70c8c9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/Standings.vue":
/*!******************************************!*\
  !*** ./resources/js/views/Standings.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Standings_vue_vue_type_template_id_14c4b418_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Standings.vue?vue&type=template&id=14c4b418&scoped=true& */ "./resources/js/views/Standings.vue?vue&type=template&id=14c4b418&scoped=true&");
/* harmony import */ var _Standings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Standings.vue?vue&type=script&lang=js& */ "./resources/js/views/Standings.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Standings_vue_vue_type_style_index_0_id_14c4b418_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss& */ "./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Standings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Standings_vue_vue_type_template_id_14c4b418_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Standings_vue_vue_type_template_id_14c4b418_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "14c4b418",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Standings.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Standings.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./resources/js/views/Standings.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Standings.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss& ***!
  \****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_style_index_0_id_14c4b418_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=style&index=0&id=14c4b418&scoped=true&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_style_index_0_id_14c4b418_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_style_index_0_id_14c4b418_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_style_index_0_id_14c4b418_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_style_index_0_id_14c4b418_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/views/Standings.vue?vue&type=template&id=14c4b418&scoped=true&":
/*!*************************************************************************************!*\
  !*** ./resources/js/views/Standings.vue?vue&type=template&id=14c4b418&scoped=true& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_template_id_14c4b418_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Standings.vue?vue&type=template&id=14c4b418&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Standings.vue?vue&type=template&id=14c4b418&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_template_id_14c4b418_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Standings_vue_vue_type_template_id_14c4b418_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
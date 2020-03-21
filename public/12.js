(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[12],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/music/SongEditor.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/media/music/SongEditor.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var music_metadata_browser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! music-metadata-browser */ "./node_modules/music-metadata-browser/lib/index.js");
/* harmony import */ var music_metadata_browser__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(music_metadata_browser__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _util_validators_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../util/validators.js */ "./resources/js/util/validators.js");
/* harmony import */ var _api_admin_mediaApi_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../api/admin/mediaApi.js */ "./resources/js/api/admin/mediaApi.js");
/* harmony import */ var string_similarity__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! string-similarity */ "./node_modules/string-similarity/src/index.js");
/* harmony import */ var string_similarity__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(string_similarity__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _events__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../events */ "./resources/js/events.js");
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
  name: "SongEditor",
  props: {
    providedFile: {
      type: Object,
      "default": null
    }
  },
  created: function created() {
    var _this = this;

    Object(_api_admin_mediaApi_js__WEBPACK_IMPORTED_MODULE_2__["fetchGenres"])().then(function (genres) {
      if (genres) _this.genres = genres;
      if (_this.$route.params.id) _this.fetchSong(_this.$route.params.id);
    });
  },
  data: function data() {
    return {
      missedArtists: [],
      missedAlbums: [],
      mp3File: this.providedFile,
      genres: [],
      song: {
        id: null,
        title: null,
        lyrics: null,
        year: null,
        genres: [],
        length: null,
        artistAliases: [],
        albums: [],
        label: null,
        bitrate: null,
        sample_rate: null,
        container: null,
        numberOfChannels: null,
        lossless: null,
        playtime_seconds: null
      }
    };
  },
  watch: {
    mp3File: function mp3File() {
      // this.clearForm();
      if (this.mp3File && Object(_util_validators_js__WEBPACK_IMPORTED_MODULE_1__["validateAudio"])(this.mp3File)) this.getMetaData();else this.mp3File = null;
    }
  },
  methods: {
    onArtistSelected: function onArtistSelected(artist) {
      if (artist) {
        var exists = this.song.artistAliases.find(function (alias) {
          return alias.id === artist.id;
        });

        if (!exists) {
          this.song.artistAliases.push(artist);
        }
      }

      this.$refs['artistSearch'].query = '';
      this.$refs['artistSearch'].options = [];
    },
    onAlbumSelected: function onAlbumSelected(album) {
      if (album) {
        var exists = this.song.albums.find(function (item) {
          return item.id === album.id;
        });
        if (!exists) this.song.albums.push(album);
      }

      this.$refs['albumSearch'].query = '';
      this.$refs['albumSearch'].options = [];
    },
    onGenreSelected: function onGenreSelected(genre) {
      if (genre) {
        var exists = this.song.genres.find(function (item) {
          return item.id === genre.id;
        });

        if (!exists) {
          this.song.genres.push(genre);
        }
      }

      this.$refs['genreSearch'].query = '';
    },
    getMetaData: function getMetaData() {
      var _this2 = this;

      Object(music_metadata_browser__WEBPACK_IMPORTED_MODULE_0__["parseBlob"])(this.mp3File).then(function (metadata) {
        console.log(metadata);

        _this2.fillData(metadata);
      })["catch"]();
    },
    fetchArtist: function fetchArtist(name) {
      var _this3 = this;

      Object(_api_admin_mediaApi_js__WEBPACK_IMPORTED_MODULE_2__["fetchArtistAliasesByName"])(name).then(function (aliases) {
        if (aliases && aliases.length > 0) _this3.onArtistSelected(aliases[0]);else _this3.missedArtists.push(name);
      });
    },
    fetchAlbum: function fetchAlbum(title) {
      var _this4 = this;

      Object(_api_admin_mediaApi_js__WEBPACK_IMPORTED_MODULE_2__["fetchFilteredAlbums"])({
        'title': title
      }).then(function (albums) {
        if (albums && albums.length > 0) _this4.onAlbumSelected(albums[0]);else _this4.missedAlbum = title;
      });
    },
    fetchSong: function fetchSong(id) {
      var _this5 = this;

      Object(_api_admin_mediaApi_js__WEBPACK_IMPORTED_MODULE_2__["fetchSong"])(id).then(function (song) {
        _this5.song = song;
      })["catch"]();
    },
    submit: function submit() {
      var _this6 = this;

      var data = new FormData();
      if (this.song.id) data.append('id', this.song.id);
      if (this.mp3File) data.append('mp3File', this.mp3File, this.mp3File.name);
      data.append('title', this.song.title);
      data.append('year', String(this.song.year));
      data.append('label', this.song.label);
      if (this.song.lyrics) data.append('lyrics', this.song.lyrics);

      for (var i = 0; i < this.song.artistAliases.length; i++) {
        data.append('artistAliases[]', this.song.artistAliases[i].id);
      }

      for (var j = 0; j < this.song.genres.length; j++) {
        data.append('genres[]', this.song.genres[j].id);
      }

      for (var k = 0; k < this.song.albums.length; k++) {
        data.append('albums[]', this.song.albums[k].id);
      }

      axios.post('/media/music/song', data).then(function (response) {
        _this6.clearForm(true);

        _this6.$router.replace('/media/song');
      })["catch"]();
    },
    removeArtistAlias: function removeArtistAlias(id) {
      this.song.artistAliases = this.song.artistAliases.filter(function (alias) {
        return alias.id !== id;
      });
    },
    removeAlbum: function removeAlbum(id) {
      this.song.albums = this.song.albums.filter(function (album) {
        return album.id !== id;
      });
    },
    removeGenre: function removeGenre(id) {
      this.song.genres = this.song.genres.filter(function (genre) {
        return genre.id !== id;
      });
    },
    fillData: function fillData(meta) {
      var _this7 = this;

      this.song.title = meta.common.title;
      this.song.year = meta.common.year;
      this.song.label = meta.common.label[0];
      this.song.bitrate = meta.format.bitrate;
      this.song.sample_rate = meta.format.sampleRate;
      this.song.container = meta.format.container;
      this.song.numberOfChannels = meta.format.numberOfChannels;
      this.song.playtime_seconds = meta.format.duration;
      this.song.lossless = meta.format.lossless;
      if (meta.common.artists) for (var i = 0; i < meta.common.artists.length; i++) {
        this.fetchArtist(meta.common.artists[i]);
      }
      if (meta.common.album) this.fetchAlbum(meta.common.album);

      if (meta.common.genre) {
        var _loop = function _loop(j) {
          var genreName = meta.common.genre[j].replace(/[^a-zA-Z]/g, '').toUpperCase();
          var bestMatch = {
            score: 0,
            genre: null
          };

          for (var k = 0; k < _this7.genres.length; k = k + 1) {
            var enScore = string_similarity__WEBPACK_IMPORTED_MODULE_3__["compareTwoStrings"](genreName, _this7.genres[k].name.replace(/[^a-zA-Z]/g, '').toUpperCase());
            var ruScore = string_similarity__WEBPACK_IMPORTED_MODULE_3__["compareTwoStrings"](genreName, _this7.genres[k].local_name.replace(/[^\u0410-\u042F\u0430-\u044F]/g, '').toUpperCase());
            var score = enScore > ruScore ? enScore : ruScore;

            if (score > bestMatch.score) {
              bestMatch.score = score;
              bestMatch.genre = _this7.genres[k];
            }
          }

          var existing = _this7.song.genres.find(function (genre) {
            return bestMatch.genre.id === genre.id;
          });

          if (!existing) _this7.song.genres.push(bestMatch.genre);
        };

        for (var j = 0; j < meta.common.genre.length; j++) {
          _loop(j);
        }
      }
    },
    clearForm: function clearForm() {
      var removeFile = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.song = {
        id: null,
        title: null,
        lyrics: null,
        year: null,
        genres: [],
        length: null,
        artistAliases: [],
        albums: [],
        label: null,
        bitrate: null,
        sample_rate: null,
        container: null,
        numberOfChannels: null,
        lossless: null,
        playtime_seconds: null
      };
      this.missedAlbums = [];
      this.missedArtists = [];

      if (removeFile) {
        this.mp3File = null;
        this.$refs['mp3FileInput'].reset();
      }

      Object(_events__WEBPACK_IMPORTED_MODULE_4__["invokeErrorResetRequested"])();
    }
  },
  computed: {
    audioSrc: function audioSrc() {
      if (this.mp3File) return URL.createObjectURL(this.mp3File);
      if (this.song.id) return "/media/music/song/".concat(this.song.id, "/audio");
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/music/SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/media/music/SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      !Boolean(_vm.providedFile)
        ? _c(
            "div",
            { staticClass: "align-items-end col-md-6 form-group" },
            [
              _c("label", [_vm._v("Файл")]),
              _vm._v(" "),
              _c("b-form-file", {
                ref: "mp3FileInput",
                attrs: {
                  state: Boolean(_vm.audioSrc) || Boolean(_vm.mp3File),
                  accept: ".mp3",
                  placeholder: "Выберите файл или перетащите его сюда...",
                  "drop-placeholder": "Перетащите файл сюда...",
                  "browse-text": "Обзор"
                },
                model: {
                  value: _vm.mp3File,
                  callback: function($$v) {
                    _vm.mp3File = $$v
                  },
                  expression: "mp3File"
                }
              })
            ],
            1
          )
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "row ml-1 col-md-6" }, [
        _c("audio", {
          staticClass: "mt-md-4 mx-auto",
          attrs: { controlsList: "nodownload", src: _vm.audioSrc, controls: "" }
        })
      ])
    ]),
    _vm._v(" "),
    _vm.song.bitrate
      ? _c("div", { staticClass: "alert alert-info" }, [
          _c("span", [
            _vm._v(
              _vm._s(_vm.song.bitrate / 1000) +
                " kbs |\n            " +
                _vm._s(_vm.song.sample_rate) +
                " |\n            "
            ),
            _vm.song.container
              ? _c("span", [_vm._v(_vm._s(_vm.song.container) + " |")])
              : _vm._e(),
            _vm._v(" "),
            _vm.song.encoder
              ? _c("span", [_vm._v(_vm._s(_vm.song.encoder) + " |")])
              : _vm._e(),
            _vm._v(
              "\n            " +
                _vm._s(Math.round((_vm.song.playtime_seconds / 60) * 100) / 100)
            )
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "form-group col-md-8" }, [
        _c("label", [_vm._v("Название")]),
        _vm._v(" "),
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.song.title,
              expression: "song.title"
            }
          ],
          staticClass: "form-control",
          attrs: { type: "text", autofocus: "" },
          domProps: { value: _vm.song.title },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.song, "title", $event.target.value)
            }
          }
        })
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "form-group col-md-4 " }, [
        _c("label", [_vm._v("Год")]),
        _vm._v(" "),
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.song.year,
              expression: "song.year"
            }
          ],
          staticClass: "form-control",
          attrs: { type: "text" },
          domProps: { value: _vm.song.year },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.song, "year", $event.target.value)
            }
          }
        })
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "form-group" },
      [
        _c("label", [_vm._v("Исполнители")]),
        _vm._v(" "),
        _c("suggestion-input", {
          ref: "artistSearch",
          attrs: {
            displayPropertyName: "name",
            "action-url": "/media/artist/alias/filter?name="
          },
          on: { selected: _vm.onArtistSelected }
        }),
        _vm._v(" "),
        _c(
          "ul",
          {
            staticClass: "list-unstyled d-inline-flex flex-wrap mb-0",
            attrs: {
              "aria-live": "polite",
              "aria-atomic": "false",
              "aria-relevant": "additions removals"
            }
          },
          _vm._l(_vm.song.artistAliases, function(artistAlias) {
            return _c(
              "b-card",
              {
                key: artistAlias.id,
                staticClass: "mt-1 mr-1 bg-warning",
                attrs: {
                  id:
                    "artistAliasesTagList_" +
                    artistAlias.name.replace(/\s/g, "_") +
                    "_",
                  tag: "li",
                  "body-class": "py-1 pr-2 text-nowrap"
                }
              },
              [
                _c("strong", [_vm._v(_vm._s(artistAlias.name))]),
                _vm._v(" "),
                _c(
                  "b-button",
                  {
                    staticClass: "text-decoration-none",
                    attrs: {
                      variant: "link",
                      size: "sm",
                      "aria-controls":
                        "artistAliasesTagList__" +
                        artistAlias.name.replace(/\s/g, "_") +
                        "_"
                    },
                    on: {
                      click: function($event) {
                        return _vm.removeArtistAlias(artistAlias.id)
                      }
                    }
                  },
                  [_vm._v("×\n                ")]
                )
              ],
              1
            )
          }),
          1
        ),
        _vm._v(" "),
        _vm.missedArtists.length > 0
          ? _c(
              "span",
              { staticClass: "small" },
              [
                _vm._v("Исполнители не найдены:\n            "),
                _vm._l(_vm.missedArtists, function(artist) {
                  return _c("b", [_vm._v(_vm._s(artist))])
                })
              ],
              2
            )
          : _vm._e()
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "form-group" },
      [
        _c("label", [_vm._v("Жанры")]),
        _vm._v(" "),
        _c("suggestion-input", {
          ref: "genreSearch",
          attrs: {
            displayPropertyName: "name",
            providedOptions: _vm.genres,
            searchPropertyName: "name"
          },
          on: { selected: _vm.onGenreSelected }
        }),
        _vm._v(" "),
        _c(
          "ul",
          {
            staticClass: "list-unstyled d-inline-flex flex-wrap mb-0",
            attrs: {
              "aria-live": "polite",
              "aria-atomic": "false",
              "aria-relevant": "additions removals"
            }
          },
          _vm._l(_vm.song.genres, function(genre) {
            return _c(
              "b-card",
              {
                key: genre.id,
                staticClass: "mt-1 mr-1 bg-warning",
                attrs: {
                  id: "genresTagList_" + genre.id.replace(/\s/g, "_") + "_",
                  tag: "li",
                  "body-class": "py-1 pr-2 text-nowrap"
                }
              },
              [
                _c("strong", [_vm._v(_vm._s(genre.name))]),
                _vm._v(" "),
                _c(
                  "b-button",
                  {
                    staticClass: "text-decoration-none",
                    attrs: {
                      variant: "link",
                      size: "sm",
                      "aria-controls":
                        "genresTagList__" + genre.id.replace(/\s/g, "_") + "_"
                    },
                    on: {
                      click: function($event) {
                        return _vm.removeGenre(genre.id)
                      }
                    }
                  },
                  [_vm._v("×\n                ")]
                )
              ],
              1
            )
          }),
          1
        )
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "form-group" },
      [
        _c("label", [_vm._v("Альбомы")]),
        _vm._v(" "),
        _c("suggestion-input", {
          ref: "albumSearch",
          attrs: {
            displayPropertyName: "title",
            "action-url": "/media/music/album/filter?title="
          },
          on: { selected: _vm.onAlbumSelected }
        }),
        _vm._v(" "),
        _c(
          "ul",
          {
            staticClass: "list-unstyled d-inline-flex flex-wrap mb-0",
            attrs: {
              "aria-live": "polite",
              "aria-atomic": "false",
              "aria-relevant": "additions removals"
            }
          },
          _vm._l(_vm.song.albums, function(album) {
            return _c(
              "b-card",
              {
                key: album.id,
                staticClass: "mt-1 mr-1 bg-warning",
                attrs: {
                  id: "albumsTagList_" + album.id.replace(/\s/g, "_") + "_",
                  tag: "li",
                  "body-class": "py-1 pr-2 text-nowrap"
                }
              },
              [
                _c("strong", [_vm._v(_vm._s(album.title))]),
                _vm._v(" "),
                _c(
                  "b-button",
                  {
                    staticClass: "text-decoration-none",
                    attrs: {
                      variant: "link",
                      size: "sm",
                      "aria-controls":
                        "albumsTagList__" + album.id.replace(/\s/g, "_") + "_"
                    },
                    on: {
                      click: function($event) {
                        return _vm.removeAlbum(album.id)
                      }
                    }
                  },
                  [_vm._v("×\n                ")]
                )
              ],
              1
            )
          }),
          1
        )
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "form-group" }, [
      _c("label", [_vm._v("Лэйбл")]),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.song.label,
            expression: "song.label"
          }
        ],
        staticClass: "form-control",
        attrs: { type: "text" },
        domProps: { value: _vm.song.label },
        on: {
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.$set(_vm.song, "label", $event.target.value)
          }
        }
      })
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "form-group" },
      [
        _c("label", [_vm._v("Текст песни")]),
        _vm._v(" "),
        _c("b-form-textarea", {
          attrs: { rows: "5", "max-rows": "15" },
          model: {
            value: _vm.song.lyrics,
            callback: function($$v) {
              _vm.$set(_vm.song, "lyrics", $$v)
            },
            expression: "song.lyrics"
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

/***/ "./resources/js/api/admin/mediaApi.js":
/*!********************************************!*\
  !*** ./resources/js/api/admin/mediaApi.js ***!
  \********************************************/
/*! exports provided: fetchGenres, fetchArtistAliasesByName, fetchFilteredAlbums, fetchSong, fetchAlbum, fetchAlbumTypes */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fetchGenres", function() { return fetchGenres; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fetchArtistAliasesByName", function() { return fetchArtistAliasesByName; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fetchFilteredAlbums", function() { return fetchFilteredAlbums; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fetchSong", function() { return fetchSong; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fetchAlbum", function() { return fetchAlbum; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fetchAlbumTypes", function() { return fetchAlbumTypes; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _util_stringHelper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../util/stringHelper */ "./resources/js/util/stringHelper.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


function fetchGenres() {
  return _fetchGenres.apply(this, arguments);
}

function _fetchGenres() {
  _fetchGenres = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            return _context.abrupt("return", axios.get('/media/music/genre'));

          case 1:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _fetchGenres.apply(this, arguments);
}

function fetchArtistAliasesByName(_x) {
  return _fetchArtistAliasesByName.apply(this, arguments);
}

function _fetchArtistAliasesByName() {
  _fetchArtistAliasesByName = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(name) {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            return _context2.abrupt("return", axios.get("/media/artist/alias/filter?name=".concat(name)));

          case 1:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2);
  }));
  return _fetchArtistAliasesByName.apply(this, arguments);
}

function fetchFilteredAlbums(_x2) {
  return _fetchFilteredAlbums.apply(this, arguments);
}

function _fetchFilteredAlbums() {
  _fetchFilteredAlbums = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(params) {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
      while (1) {
        switch (_context3.prev = _context3.next) {
          case 0:
            return _context3.abrupt("return", axios.get('/media/music/album/filter?' + Object(_util_stringHelper__WEBPACK_IMPORTED_MODULE_1__["kvpToQueryParam"])(params)));

          case 1:
          case "end":
            return _context3.stop();
        }
      }
    }, _callee3);
  }));
  return _fetchFilteredAlbums.apply(this, arguments);
}

function fetchSong(_x3) {
  return _fetchSong.apply(this, arguments);
}

function _fetchSong() {
  _fetchSong = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(id) {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
      while (1) {
        switch (_context4.prev = _context4.next) {
          case 0:
            return _context4.abrupt("return", axios.get("/media/music/song/".concat(id)));

          case 1:
          case "end":
            return _context4.stop();
        }
      }
    }, _callee4);
  }));
  return _fetchSong.apply(this, arguments);
}

function fetchAlbum(_x4) {
  return _fetchAlbum.apply(this, arguments);
}

function _fetchAlbum() {
  _fetchAlbum = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(id) {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
      while (1) {
        switch (_context5.prev = _context5.next) {
          case 0:
            return _context5.abrupt("return", axios.get("/media/music/album/".concat(id)));

          case 1:
          case "end":
            return _context5.stop();
        }
      }
    }, _callee5);
  }));
  return _fetchAlbum.apply(this, arguments);
}

function fetchAlbumTypes() {
  return _fetchAlbumTypes.apply(this, arguments);
}

function _fetchAlbumTypes() {
  _fetchAlbumTypes = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
      while (1) {
        switch (_context6.prev = _context6.next) {
          case 0:
            return _context6.abrupt("return", axios.get('/media/music/album/types'));

          case 1:
          case "end":
            return _context6.stop();
        }
      }
    }, _callee6);
  }));
  return _fetchAlbumTypes.apply(this, arguments);
}

/***/ }),

/***/ "./resources/js/components/admin/media/music/SongEditor.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/admin/media/music/SongEditor.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SongEditor_vue_vue_type_template_id_3b8ea902_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true& */ "./resources/js/components/admin/media/music/SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true&");
/* harmony import */ var _SongEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SongEditor.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/media/music/SongEditor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SongEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SongEditor_vue_vue_type_template_id_3b8ea902_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SongEditor_vue_vue_type_template_id_3b8ea902_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3b8ea902",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/media/music/SongEditor.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/media/music/SongEditor.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/admin/media/music/SongEditor.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SongEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SongEditor.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/music/SongEditor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SongEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/media/music/SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true&":
/*!*************************************************************************************************************!*\
  !*** ./resources/js/components/admin/media/music/SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true& ***!
  \*************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SongEditor_vue_vue_type_template_id_3b8ea902_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/media/music/SongEditor.vue?vue&type=template&id=3b8ea902&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SongEditor_vue_vue_type_template_id_3b8ea902_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SongEditor_vue_vue_type_template_id_3b8ea902_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/events.js":
/*!********************************!*\
  !*** ./resources/js/events.js ***!
  \********************************/
/*! exports provided: invokeErrorResetRequested */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "invokeErrorResetRequested", function() { return invokeErrorResetRequested; });
function invokeErrorResetRequested() {
  window.Vue.prototype.$eventHub.$emit('error-reset-requested');
}

/***/ }),

/***/ "./resources/js/util/stringHelper.js":
/*!*******************************************!*\
  !*** ./resources/js/util/stringHelper.js ***!
  \*******************************************/
/*! exports provided: kvpToQueryParam */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "kvpToQueryParam", function() { return kvpToQueryParam; });
function kvpToQueryParam(kvArray) {
  var query = '';

  for (var key in kvArray) {
    query += "".concat(key, "=").concat(kvArray[key], "&");
  }

  return query;
}

/***/ }),

/***/ "./resources/js/util/validators.js":
/*!*****************************************!*\
  !*** ./resources/js/util/validators.js ***!
  \*****************************************/
/*! exports provided: validateAudio */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validateAudio", function() { return validateAudio; });
function validateAudio(file) {
  var types = /(\.|\/)(mp3|ogg|wav)$/i;
  return types.test(file.type) || types.test(file.name);
}

/***/ }),

/***/ 1:
/*!**********************!*\
  !*** util (ignored) ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ }),

/***/ 2:
/*!**********************!*\
  !*** util (ignored) ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ })

}]);
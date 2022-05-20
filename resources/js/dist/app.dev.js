"use strict";

var _alpinejs = _interopRequireDefault(require("alpinejs"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

require('./bootstrap');

window.Alpine = _alpinejs["default"];

_alpinejs["default"].start();

moment.locale('es');
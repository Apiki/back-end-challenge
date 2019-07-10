var _Object$getOwnPropertyDescriptors = require("../core-js/object/get-own-property-descriptors");

var _Object$defineProperties = require("../core-js/object/define-properties");

var _Object$getOwnPropertyDescriptor = require("../core-js/object/get-own-property-descriptor");

var _Object$getOwnPropertySymbols = require("../core-js/object/get-own-property-symbols");

var _Object$keys = require("../core-js/object/keys");

var defineProperty = require("./defineProperty");

function _objectSpread2(target) {
  for (var i = 1; i < arguments.length; i++) {
    if (i % 2) {
      var source = arguments[i] != null ? arguments[i] : {};

      var ownKeys = _Object$keys(source);

      if (typeof _Object$getOwnPropertySymbols === 'function') {
        ownKeys = ownKeys.concat(_Object$getOwnPropertySymbols(source).filter(function (sym) {
          return _Object$getOwnPropertyDescriptor(source, sym).enumerable;
        }));
      }

      ownKeys.forEach(function (key) {
        defineProperty(target, key, source[key]);
      });
    } else {
      _Object$defineProperties(target, _Object$getOwnPropertyDescriptors(arguments[i]));
    }
  }

  return target;
}

module.exports = _objectSpread2;
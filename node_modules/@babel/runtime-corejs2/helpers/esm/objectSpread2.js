import _Object$getOwnPropertyDescriptors from "../../core-js/object/get-own-property-descriptors";
import _Object$defineProperties from "../../core-js/object/define-properties";
import _Object$getOwnPropertyDescriptor from "../../core-js/object/get-own-property-descriptor";
import _Object$getOwnPropertySymbols from "../../core-js/object/get-own-property-symbols";
import _Object$keys from "../../core-js/object/keys";
import defineProperty from "./defineProperty";
export default function _objectSpread2(target) {
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
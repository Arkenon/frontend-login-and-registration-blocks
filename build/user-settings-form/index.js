/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/components/ButtonSettings.js":
/*!******************************************!*\
  !*** ./src/components/ButtonSettings.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _CustomControls__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./CustomControls */ "./src/components/CustomControls.js");




const ButtonSettings = ({
  options
}) => {
  const {
    attributes,
    setAttributes
  } = options;
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Button Settings', 'flr-blocks'),
    initialOpen: false
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.RangeControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Button Border Radius', 'flr-blocks'),
    value: attributes.buttonBorderRadius,
    onChange: val => setAttributes({
      buttonBorderRadius: val
    }),
    min: 0,
    max: 25
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CustomControls__WEBPACK_IMPORTED_MODULE_3__.FlrBorderControl, {
    options: options,
    attributeName: "buttonBorder"
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.__experimentalText, null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Button Background Color', 'flr-blocks'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CustomControls__WEBPACK_IMPORTED_MODULE_3__.FlrColorPalette, {
    options: options,
    attributeName: "buttonBgColor"
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
    labelPosition: 'top',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Button Font Weight', 'flr-blocks'),
    value: attributes.buttonTextFontWeight,
    options: [{
      label: 'Normal',
      value: 'normal'
    }, {
      label: 'Bold',
      value: 'bold'
    }],
    onChange: val => setAttributes({
      buttonTextFontWeight: val
    })
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.__experimentalText, null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Button Text Color', 'flr-blocks'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CustomControls__WEBPACK_IMPORTED_MODULE_3__.FlrColorPalette, {
    options: options,
    attributeName: "buttonTextColor"
  }))));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ButtonSettings);

/***/ }),

/***/ "./src/components/CustomControls.js":
/*!******************************************!*\
  !*** ./src/components/CustomControls.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   FlrBorderControl: () => (/* binding */ FlrBorderControl),
/* harmony export */   FlrColorPalette: () => (/* binding */ FlrColorPalette)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);





function getThemeColors() {
  const [colors, setColors] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    const getThemeData = select('core').getCurrentTheme();
    const themeJsonPath = `/wp-content/themes/${getThemeData.stylesheet}/theme.json`;
    fetch(themeJsonPath).then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then(themeJson => {
      if (getThemeData.is_block_theme) {
        const palettes = themeJson.settings.color.palette;
        const newColors = palettes.map(palette => ({
          color: palette.color,
          name: palette.name
        }));
        setColors(newColors);
      }
    }).catch(error => {
      console.error('Error fetching the theme.json file:', error);
    });
  }, []);
  return colors;
}
const FlrColorPalette = ({
  options,
  attributeName
}) => {
  const {
    attributes,
    setAttributes
  } = options;
  const colors = getThemeColors();
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ColorPalette, {
    colors: colors,
    value: attributes[attributeName],
    onChange: color => setAttributes({
      [attributeName]: color
    })
  });
};
const FlrBorderControl = ({
  options,
  attributeName
}) => {
  const {
    attributes,
    setAttributes
  } = options;
  const colors = getThemeColors();
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.__experimentalBorderControl, {
    colors: colors,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Button Border', 'flr-blocks'),
    onChange: newButtonBorder => {
      if (newButtonBorder != undefined) {
        setAttributes({
          [attributeName]: newButtonBorder
        });
      }
    },
    value: attributes[attributeName]
  });
};

/***/ }),

/***/ "./src/components/InputSettings.js":
/*!*****************************************!*\
  !*** ./src/components/InputSettings.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);



const InputSettings = ({
  options
}) => {
  const {
    attributes,
    setAttributes
  } = options;
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Input Settings', 'flr-blocks'),
    initialOpen: false
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.RangeControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Input Border Radius', 'flr-blocks'),
    value: attributes.inputBorderRadius,
    onChange: val => setAttributes({
      inputBorderRadius: val
    }),
    min: 0,
    max: 25
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToggleControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Show Placeholders', 'flr-blocks'),
    help: attributes.showPlaceholders ? 'Show' : 'Hide',
    checked: attributes.showPlaceholders,
    onChange: val => setAttributes({
      showPlaceholders: val
    })
  }))));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (InputSettings);

/***/ }),

/***/ "./src/components/LabelSettings.js":
/*!*****************************************!*\
  !*** ./src/components/LabelSettings.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _CustomControls__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./CustomControls */ "./src/components/CustomControls.js");




const LabelSettings = ({
  options
}) => {
  const {
    attributes,
    setAttributes
  } = options;
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Label Settings', 'flr-blocks'),
    initialOpen: false
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToggleControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Show labels', 'flr-blocks'),
    help: attributes.showLabels ? 'Show' : 'Hide',
    checked: attributes.showLabels,
    onChange: val => setAttributes({
      showLabels: val
    })
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
    labelPosition: 'top',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Font Weight & Font Color', 'flr-blocks'),
    value: attributes.textFontWeight,
    options: [{
      label: 'Normal',
      value: 'normal'
    }, {
      label: 'Bold',
      value: 'bold'
    }],
    onChange: val => setAttributes({
      textFontWeight: val
    })
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CustomControls__WEBPACK_IMPORTED_MODULE_3__.FlrColorPalette, {
    options: options,
    attributeName: "textColor"
  }))));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (LabelSettings);

/***/ }),

/***/ "./src/user-settings-form/edit.js":
/*!****************************************!*\
  !*** ./src/user-settings-form/edit.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Edit)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./editor.scss */ "./src/user-settings-form/editor.scss");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _options__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./options */ "./src/user-settings-form/options.js");





function Edit(props) {
  const {
    attributes
  } = props;
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)(props);
  const inputStyle = {
    'border-radius': attributes.inputBorderRadius
  };
  const textStyle = {
    'color': attributes.textColor,
    'font-weight': attributes.textFontWeight
  };
  const buttonStyle = {
    'color': attributes.buttonTextColor,
    'backgroundColor': attributes.buttonBgColor,
    'border-color': attributes.buttonBorder.color,
    'border-style': attributes.buttonBorder.style,
    'border-width': attributes.buttonBorder.width,
    'border-radius': attributes.buttonBorderRadius,
    'font-weight': attributes.buttonTextFontWeight
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_options__WEBPACK_IMPORTED_MODULE_4__["default"], {
    options: props
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    ...blockProps
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-user-first-name"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('First Name (optional)', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-user-first-name",
    type: "text",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your first name', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-user-last-name"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Last Name (optional)', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-user-last-name",
    type: "text",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your last name', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-user-website"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Website Url (optional)', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-user-website",
    type: "text",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your website url', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-user-bio"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Your short bio (optional)', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    className: "flr-blocks-textarea-control",
    name: "flr-blocks-user-bio",
    id: "flr-blocks-user-bio",
    cols: "30",
    rows: "10"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-email-update"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Your e-mail', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-email-update",
    type: "text",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your e-mail', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-current-password"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Current Password', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-current-password",
    type: "password",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your current password', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-password-update"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('New Password', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-password-update",
    type: "password",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your new password', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-input-group"
  }, attributes.showLabels && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "flr-blocks-input-label",
    style: textStyle,
    htmlFor: "flr-blocks-password-again-update"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('New Password Again', 'flr-blocks')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "flr-blocks-input-control",
    id: "flr-blocks-password-again-update",
    type: "password",
    style: inputStyle,
    placeholder: attributes.showPlaceholders && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Enter your new password again', 'flr-blocks')
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flr-blocks-form-row"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    style: buttonStyle,
    type: "submit",
    name: "wp-submit",
    id: "flr-blocks-user-settings-submit",
    className: "flr-blocks-update-user-btn flr-blocks-btn wp-block-button__link wp-element-button"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Update User', 'flr-blocks')))));
}

/***/ }),

/***/ "./src/user-settings-form/index.js":
/*!*****************************************!*\
  !*** ./src/user-settings-form/index.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/user-settings-form/style.scss");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/user-settings-form/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./save */ "./src/user-settings-form/save.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./block.json */ "./src/user-settings-form/block.json");
/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */


/**
 * Internal dependencies
 */




/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_4__.name, {
  /**
   * @see ./edit.js
   */
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  /**
   * @see ./save.js
   */
  save: _save__WEBPACK_IMPORTED_MODULE_3__["default"]
});

/***/ }),

/***/ "./src/user-settings-form/options.js":
/*!*******************************************!*\
  !*** ./src/user-settings-form/options.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_LabelSettings__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/LabelSettings */ "./src/components/LabelSettings.js");
/* harmony import */ var _components_ButtonSettings__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/ButtonSettings */ "./src/components/ButtonSettings.js");
/* harmony import */ var _components_InputSettings__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../components/InputSettings */ "./src/components/InputSettings.js");





const Options = ({
  options
}) => {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_LabelSettings__WEBPACK_IMPORTED_MODULE_2__["default"], {
    options: options
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_InputSettings__WEBPACK_IMPORTED_MODULE_4__["default"], {
    options: options
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ButtonSettings__WEBPACK_IMPORTED_MODULE_3__["default"], {
    options: options
  }));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Options);

/***/ }),

/***/ "./src/user-settings-form/save.js":
/*!****************************************!*\
  !*** ./src/user-settings-form/save.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ save)
/* harmony export */ });
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__);
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */


/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
function save() {}

/***/ }),

/***/ "./src/user-settings-form/editor.scss":
/*!********************************************!*\
  !*** ./src/user-settings-form/editor.scss ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/user-settings-form/style.scss":
/*!*******************************************!*\
  !*** ./src/user-settings-form/style.scss ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./src/user-settings-form/block.json":
/*!*******************************************!*\
  !*** ./src/user-settings-form/block.json ***!
  \*******************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"frontend-login-with-gutenberg-blocks/user-settings-form","version":"1.0.0","title":"User Settings Form","category":"theme","icon":"list-view","description":"Display user settings form","attributes":{"showLabels":{"type":"boolean","default":true},"showPlaceholders":{"type":"boolean","default":false},"textColor":{"type":"string","default":"black"},"textFontWeight":{"type":"string","default":"bold"},"inputBorderRadius":{"type":"number","default":0},"buttonBgColor":{"type":"string","default":"gray"},"buttonTextColor":{"type":"string","default":"black"},"buttonBorder":{"type":"object","default":{"color":"#000","style":"solid","width":"0px"}},"buttonBorderRadius":{"type":"number","default":0},"buttonTextFontWeight":{"type":"string","default":"normal"}},"supports":{"html":false},"textdomain":"user-settings-form","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"user-settings-form/index": 0,
/******/ 			"user-settings-form/style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunkfrontend_login_with_gutenberg_blocks"] = globalThis["webpackChunkfrontend_login_with_gutenberg_blocks"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["user-settings-form/style-index"], () => (__webpack_require__("./src/user-settings-form/index.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map
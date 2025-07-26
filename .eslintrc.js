const defaultConfig = require('@wordpress/scripts/config/.eslintrc.js');

module.exports = {
    ...defaultConfig,
    root: true, // This prevents ESLint from looking for configs in parent directories
};

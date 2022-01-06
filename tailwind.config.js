// Include the fast-glob package so we can use the glob patterns
// This fixes an issue with infinite compiling see: https://github.com/laravel-mix/laravel-mix/issues/1942#issuecomment-998148038
const fastglob = require('fast-glob');

module.exports = {
  content: fastglob.sync([
    './**/*.php',
    './assets/js/**/*.js'
  ]),
  theme: {
    extend: {},
  },
  corePlugins: {
    container: false, // Disable container as we will create our own and this will avoid any conflicts
  },
  plugins: [],
}

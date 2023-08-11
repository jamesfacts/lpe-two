import {domReady} from '@roots/sage/client';
import Alpine from 'alpinejs';
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
import homeTemplate from './forms.js';
import postTemplate from './posts.js';

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code
  window.Alpine = Alpine
  Alpine.start()
  homeTemplate.init()
  postTemplate.init()  
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);

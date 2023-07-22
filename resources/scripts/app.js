import {domReady} from '@roots/sage/client';
import Alpine from 'alpinejs';
import homeTemplate from './forms.js';

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
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);

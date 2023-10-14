import {domReady} from '@roots/sage/client';
import { wrapGrid } from 'animate-css-grid';
import Alpine from 'alpinejs';
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
import homeTemplate from './forms.js';
import postTemplate from './posts.js';
import amriSingle from './amri-single.js';
import conference from './conference.js';

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
  amriSingle.init()
  
  const grid = document.querySelector(".conference-panels");
  wrapGrid(grid);

  conference.init()
  
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);

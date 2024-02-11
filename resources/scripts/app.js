import {domReady} from '@roots/sage/client';
import { wrapGrid } from 'animate-css-grid';
import Alpine from 'alpinejs';
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
import homeTemplate from './forms.js';
import postTemplate from './posts.js';
import amriSingle from './amri-single.js';
import conference from './conference.js';
import archive from './archive.js';

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
  conference.init()
  archive.init()

  const grid = document.querySelector(".conference-panels");
  wrapGrid(grid,
    {
      // int: default is 0 ms
      stagger: 50,
      // int: default is 250 ms
      duration: 550,
      // string: default is 'easeInOut'
      easing: 'backInOut',
      // function: called with list of elements about to animate
      onStart: (animatingElementList)=> {},
      // function: called with list of elements that just finished animating
      // cancelled animations will not trigger onEnd
      onEnd: (animatingElementList)=> {}
    });

  
  
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);

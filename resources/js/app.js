import './bootstrap';
import 'popper.js';
import jQuery from 'jquery';
import './custom.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.$ = jQuery;
Alpine.start();


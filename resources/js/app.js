import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
initFlowbite();
initModals();

window.Alpine = Alpine;

Alpine.start();

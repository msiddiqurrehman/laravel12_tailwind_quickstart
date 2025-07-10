// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import './tailadmin/index';

import './jquery-3.7.1';

import './datatables/dataTables.2.3.2';

import './datatables/dataTables.2.3.2.tailwindcss';

import './datatables/extensions/responsive/dataTables.responsive.3.0.5';

import './datatables/extensions/responsive/responsive.3.0.5.dataTables';

$(document).ready(function(){
    new DataTable('#to-data-table');
});

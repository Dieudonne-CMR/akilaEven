import "./bootstrap";
import "preline";
import $ from "jquery";
import "datatables.net"; // JS de DataTables

import Alpine from "alpinejs";
window.$ = $;
window.jQuery = $;
window.DataTable = $.fn.DataTable;

window.Alpine = Alpine;
import "flyonui/dist/datatable.js";
import "flyonui/flyonui";

Alpine.start();
// Si vous souhaitez auto-initialiser
window.HSStaticMethods?.autoInit();

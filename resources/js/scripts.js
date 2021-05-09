let Utils = $.fn.select2.amd.require('select2/utils');
let Dropdown = $.fn.select2.amd.require('select2/dropdown');
let DropdownSearch = $.fn.select2.amd.require('select2/dropdown/search');
let CloseOnSelect = $.fn.select2.amd.require('select2/dropdown/closeOnSelect');
let AttachBody = $.fn.select2.amd.require('select2/dropdown/attachBody');

let dropdownAdapter = Utils.Decorate(Utils.Decorate(Utils.Decorate(Dropdown, DropdownSearch), CloseOnSelect), AttachBody);

$('#select2').select2({
    dropdownAdapter: dropdownAdapter,
    minimumResultsForSearch: 5,
}).on('select2:opening select2:closing', function (event) {
    //Disable original search (https://select2.org/searching#multi-select)
    let searchfield = $(this).parent().find('.select2-search__field');
    searchfield.prop('disabled', true);
});
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
})

$(document).ready(function() {
    $('#example').DataTable({
        language: {
            searchPlaceholder: 'Buscar registros',
            sSearch: '',
            sLengthMenu: 'Motrar _MENU_',
            sLength: 'dataTables_length',
            oPaginate: {
                sFirst: '<i class="material-icons">chevron_left</i>',
                sPrevious: '<i class="material-icons">chevron_left</i>',
                sNext: '<i class="material-icons">chevron_right</i>',
                sLast: '<i class="material-icons">chevron_right</i>' 
        }
        }
    });
    $('.dataTables_length select').addClass('browser-default');
});
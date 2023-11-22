$('document').ready(function(){
	$('.data-table').DataTable({
        scrollX:true,
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'
			}
		},
	});


    // Função para obter o índice do mês em português
    function getIndexForPortugueseMonth(month) {
        var monthArr = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        return monthArr.indexOf(month);
    }

    // Adicione a ordenação personalizada para meses em português
    $.fn.dataTable.ext.order['month-order-pt'] = function (data) {
        return getIndexForPortugueseMonth(data);
    };

    // Inicialize o DataTable com a ordenação personalizada apenas para a tabela 'data-table-export'
    $('.data-table-export').DataTable({
        scrollX: true,
        scrollY: '800px',
        scrollCollapse: true,
        autoWidth: true,
        responsive: true,
        "columnDefs": [
            {
                "targets": 0, // Índice da coluna que contém os meses
                "type": 'month-order-pt' // Aplica a ordenação personalizada
            },
            {
                "targets": "datatable-nosort",
                "orderable": false,
            }
        ],
        "language": {
            "info": "_START_-_END_ de _TOTAL_ entradas",
            "searchPlaceholder": "Pesquisar",
            "paginate": {
                "next": '<i class="ion-chevron-right"></i>',
                "previous": '<i class="ion-chevron-left"></i>',
            }
        },
        "dom": 'Bfrtp',
        "buttons": ['copy', 'csv', 'pdf', 'print'],
        "order": [
            [0, 'month-order-pt'] // 0 para a primeira coluna, 'asc' para ordenação ascendente
        ]
    });




    var table = $('.select-row').DataTable();
	$('.select-row tbody').on('click', 'tr', function () {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	var multipletable = $('.multiple-select-row').DataTable();
	$('.multiple-select-row tbody').on('click', 'tr', function () {
		$(this).toggleClass('selected');
	});
	var table = $('.checkbox-datatable').DataTable({
		'scrollCollapse': true,
		'autoWidth': false,
		'responsive': true,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'
			}
		},
		'columnDefs': [{
			'targets': 0,
			'searchable': false,
			'orderable': false,
			'className': 'dt-body-center',
			'render': function (data, type, full, meta){
				return '<div class="dt-checkbox"><input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '"><span class="dt-checkbox-label"></span></div>';
			}
		}],
		'order': [[1, 'asc']]
	});

	$('#example-select-all').on('click', function(){
		var rows = table.rows({ 'search': 'applied' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	$('.checkbox-datatable tbody').on('change', 'input[type="checkbox"]', function(){
		if(!this.checked){
			var el = $('#example-select-all').get(0);
			if(el && el.checked && ('indeterminate' in el)){
				el.indeterminate = true;
			}
		}
	});
});

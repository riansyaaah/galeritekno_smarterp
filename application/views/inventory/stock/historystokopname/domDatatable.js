function dataTableUtama() {
	$('#tableUtama').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallhistory`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'tglOpname'},
			{"data": 'itemmaster'},
			{"data": 'lama'},
			{"data": 'baru'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [0, 2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
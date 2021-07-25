function dataTablePO() {
	$('#tablePO').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getpo`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'noPO'},
			{"data": 'tglPO'},
			{"data": 'nama_lengkap'},
			{"data": 'email'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
}
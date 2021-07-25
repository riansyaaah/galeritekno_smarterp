function dataTableDetail() {
	$('#tableDetail').dataTable({
		destroy: true,
		paging: false,
		info: false,
		ajax: {
			url: `${baseUrl}getallitemlab`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'satuan'},
			{"data": 'stock'},
			{"data": 'input'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableTransactionDetail() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}gettransactiondetail`,
			dataSrc: 'data',
			type: 'post',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'satuan'},
			{"data": 'stock'},
			{"data": 'input'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
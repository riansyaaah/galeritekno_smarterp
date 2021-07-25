function dataTableUtama() {
	$('#tableUtama').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallitemmaster`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'kategori'},
			{"data": 'fixed'},
			{"data": 'bhp'},
			{"data": 'itemmaster'},
			{"data": 'besar'},
			{"data": 'kecil'},
			{"data": 'btn'},
			{"data": 'id'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [4, 5, 6]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        	$('td', row).eq(6).addClass('text-center');
        	$('td', row).eq(7).addClass('hidetd');
        },
        "order": [
        	[7, 'desc']
        ]
	});
}
function dataTableCariAccount() {
	$('#tableCariAccount').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallaccount`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'AccountNo'},
			{"data": 'AccountName'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [0, 2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        }
	});
	$('#tableCariAccount tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const accountNo = td.eq(0).text();
		document.querySelector('#accountNo').value = accountNo;
		renderBtnSaveItem();
		$('#modalCariAccount').modal('hide');
	});
}
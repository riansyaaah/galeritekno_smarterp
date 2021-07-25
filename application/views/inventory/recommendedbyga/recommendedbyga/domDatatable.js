function dataTableRequest() {
	$('#tableRequest').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getrecommend`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'no'},
			{"data": 'noRecommend'},
			{"data": 'tglRecommend'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableDetail() {
	const form = {noRecommend: document.querySelector('#noRecommend').value}
	$('#tableDetail').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaToko'},
			{"data": 'namaProduk'},
			{
				"data": 'hargaSatuan',
				render: $.fn.dataTable.render.number('.', ',', 0, '')
			},
			{
				"data": 'ongkir',
				render: $.fn.dataTable.render.number('.', ',', 0, '')
			},
			{"data": 'lokasi'},
			{"data": 'estimasi'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2, 3, 6]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(2).addClass('text-right');
        	$('td', row).eq(3).addClass('text-right');
        	$('td', row).eq(6).addClass('text-center');
        }
	});
}
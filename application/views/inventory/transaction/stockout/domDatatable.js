function dataTableOutgoing() {
	$('#tableOutgoing').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getalloutgoing`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'tglTransaction'},
			{"data": 'noTransaction'},
			{"data": 'noRequest'},
			{"data": 'nama_lengkap'},
			{"data": 'email'},
			{"data": 'department'},
			{"data": 'position'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [5]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        }
	});
}
function dataTableDetail(idTransaksi) {
	const form = {id: idTransaksi}
	$('#tableDetail').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getalldetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'unit'},
			{"data": 'jumlah_act'},
			{"data": 'status'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
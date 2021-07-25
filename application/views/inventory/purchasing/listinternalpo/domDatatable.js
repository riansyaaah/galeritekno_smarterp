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
			{"data": 'department'},
			{"data": 'status'},
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
        }
	});
}
function dataTablePODetail(noPO) {
	const form = {noPO: noPO}
	$('#tablePODetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getpodetail`,
			dataSrc: 'data',
			type: 'post',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'unit'},
			{"data": 'jumlah'},
			{"data": 'jml'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        }
	});
}
function dataTablePODetailManagerDiproses(noPO) {
	const form = {noPO: noPO}
	$('#tablePODetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getpodetail`,
			dataSrc: 'data',
			type: 'post',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'unit'},
			{"data": 'jumlah'},
			{"data": 'jmlReview'}
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
function dataTablePODetailManagerMenunggu(noPO) {
	const form = {noPO: noPO}
	$('#tablePODetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getpodetail`,
			dataSrc: 'data',
			type: 'post',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'unit'},
			{"data": 'jumlah'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        }
	});
}
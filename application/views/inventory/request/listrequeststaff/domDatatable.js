function dataTableRequest() {
	$('#tableReq').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getrequest`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'noReq'},
			{"data": 'tglReq'},
			{"data": 'nama_lengkap'},
			{"data": 'email'},
			{"data": 'status'},
			{"data": 'department'},
			{"data": 'position'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [7]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(7).addClass('text-center');
        }
	});
}
function dataTableRequestDetail() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'jmlReview'},
			{"data": 'btnValidasiManager'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        }
	});
}
function dataTableRequestDetailStaff() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'jumlah'},
			{"data": 'jmlReview'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableRequestStaffDetail() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'jumlah'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        }
	});
}
function dataTableRequestDetailKeluar() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'isMaster'},
			{"data": 'jumlah'},
			{"data": 'input'},
			{"data": 'inputKeluar'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2, 3, 4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
}
function dataTableRequestDetailKeluarManager() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'jumlah'},
			{"data": 'input'},
			{"data": 'jmlAktual'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableRequestDetailKeluarStaff() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'jumlah'},
			{"data": 'jmlReview'},
			{"data": 'jmlAktual'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableRequestDetailKeluarStaff() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'jumlah'},
			{"data": 'jmlReview'},
			{"data": 'jmlAktual'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableSwaber() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableSwaber').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getdetailswaber`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'satuan'},
			{"data": 'stock'},
			{"data": 'jumlah_act'},
			{"data": 'input'},
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        }
	});
}
function dataTableCariItem() {
	$('#tableCariItem').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallitemmaster`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'besar'},
			{"data": 'kecil'},
			{"data": 'btn'},
			{"data": 'id'},
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('hidetd');
        }
	});
	$('#tableCariItem tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const nama = td.eq(0).text();
		const id = td.eq(4).text();
		const idItemDetail = document.querySelector('#idItemDetail').value;
		const box = document.querySelector(`#item${idItemDetail}`);
		box.value = nama;
		box.dataset.idItem = id;
		$('#modalCariItem').modal('hide');
	});
}
function dataTableRequestDetailDiprosesManager() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'jmlReview'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        }
	});
}
function dataTableRequestDetailDiprosesGA() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableReqDetail').dataTable({
		destroy: true,
		bInfo: false,
		paging: false,
		searching: false,
		ordering: false,
		ajax: {
			url: `${baseUrl}getrequestdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'checkbox'},
			{"data": 'namaItem'},
			{"data": 'isMaster'},
			{"data": 'jmlAktual'},
			{"data": 'btnEditJumlah'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [0, 2, 3, 4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
}
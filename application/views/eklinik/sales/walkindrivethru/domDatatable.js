function dataTableUtama() {
	$('#tableUtama').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallregperiksa`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'no'},
			{"data": 'detailketerangan'},
			{"data": 'waktuKunjungan'},
			{"data": 'instansi'},
			{"data": 'nomorregistrasi'},
			{"data": 'nik'},
			{"data": 'nama'},
			{"data": 'ttljk'},
			{"data": 'picMarketing'},
			{"data": 'carabayar'},
			{"data": 'statushadir'},
			{"data": 'cabang'},
			{"data": 'btn'},
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [0, 12]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(12).addClass('text-center');
        }
	});
}
function dataTableDetail(idpayment) {
	const form = {idpayment: idpayment}
	$('#tableDataPeserta').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getregperiksaidpayment`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'no'},
			{"data": 'nomorregistrasi'},
			{"data": 'waktuKunjungan'},
			{"data": 'antrian_ke'},
			{"data": 'tipekunjungan'},
			{"data": 'jenis'},
			{"data": 'nama'},
			{"data": 'jeniskelamin'},
			{"data": 'tanggallahir'},
			{"data": 'nomorhp'},
			{"data": 'carabayar'},
			{"data": 'statushadir'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [12]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(7).addClass('text-center');
        	$('td', row).eq(8).addClass('text-center');
        	$('td', row).eq(10).addClass('text-center');
        	$('td', row).eq(11).addClass('text-center');
        	$('td', row).eq(12).addClass('text-center');
        }
	});
}
function dataTableFilter() {
	const form = {
		from: document.querySelector('#filterTanggalKunjunganFrom').value,
		to: document.querySelector('#filterTanggalKunjunganTo').value,
		instansi: document.querySelector('#filterInstansi').value,
		picMarketing: document.querySelector('#filterPICMarketing').value,
		paketPemeriksaan: document.querySelector('#filterPaketPemeriksaan').value,
		cabang: document.querySelector('#filterCabang').value,
		statusHasil: document.querySelector('#filterStatusHasil').value
	}
	$('#tableUtama').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallregperiksafilter`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'no'},
			{"data": 'detailketerangan'},
			{"data": 'waktuKunjungan'},
			{"data": 'instansi'},
			{"data": 'nomorregistrasi'},
			{"data": 'nik'},
			{"data": 'nama'},
			{"data": 'ttljk'},
			{"data": 'picMarketing'},
			{"data": 'carabayar'},
			{"data": 'statushadir'},
			{"data": 'cabang'},
			{"data": 'btn'},
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [0, 12]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(12).addClass('text-center');
        }
	});
}
function dataTableLog(id) {
	const form = {id: id}
	$('#tableLog').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getalllog`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'no'},
			{"data": 'waktu'},
			{"data": 'aktivitas'},
		],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        }
	});
}
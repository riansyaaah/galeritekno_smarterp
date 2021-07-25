function dataTableUtama() {
	$('#tableUtama').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getlaboratorium`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'no'},
			{"data": 'namacabang'},
			{"data": 'tanggalkunjungan'},
			{"data": 'nomorregistrasi'},
			{"data": 'jenis'},
			{"data": 'nik'},
			{"data": 'nama'},
			{"data": 'alamat'},
			{"data": 'tanggalsampling'},
			{"data": 'tanggalperiksa'},
			{"data": 'tanggalselesai'},
			{"data": 'jenissample'},
			{"data": 'ncov'},
			{"data": 'lgg'},
			{"data": 'antigen'},
			{"data": 'catatan'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [0, 16]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(8).addClass('text-center');
        	$('td', row).eq(9).addClass('text-center');
        	$('td', row).eq(10).addClass('text-center');
        	$('td', row).eq(12).addClass('text-center');
        }
	});
}
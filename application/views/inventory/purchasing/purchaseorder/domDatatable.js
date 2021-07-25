function dataTablePODetail() {
	const form = {noPO: document.querySelector('#noPO').value}
	$('#tablePODetail').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallpodetail`,
			dataSrc: 'data',
			type: 'post',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'unit'},
			{"data": 'jumlah'},
			{
				"data": 'hargaSatuan',
				render: $.fn.dataTable.render.number('.', ',', 0, '')
			},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2, 3, 4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-right');
        	$('td', row).eq(3).addClass('text-right');
        	$('td', row).eq(4).addClass('text-right');
        }
	});
}
function dataTableCariSupplier() {
	$('#tableCariSupplier').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallsupplier`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'kode'},
			{"data": 'nama'},
			{"data": 'btn'},
			{"data": 'tipe'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('hidetd');
        }
	});
	$('#tableCariSupplier tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const kode = td.eq(0).text();
		const nama = td.eq(1).text();
		const tipe = td.eq(3).text();
		const kodeSupplier = document.querySelector('#kodeSupplier');
		kodeSupplier.value = kode;
		kodeSupplier.dataset.tipe = tipe;
		document.querySelector('#namaSupplier').value = nama;
		const tanggal = document.querySelector('#tanggal');
		tanggal.disabled = false;
		tanggal.value = sekarang;
		document.querySelector('#btnSavePO').disabled = true;
		document.querySelector('#btnAdd').disabled = true;
		document.querySelector('#btnPrint').disabled = true;
		document.querySelector('#btnSelesai').disabled = true;
		document.querySelector('#konten').innerHTML = '';
		generateNoPO(sekarang);
		renderActivateBtnSave();
		$('#modalCariSupplier').modal('hide');
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
			{"data": 'satuan'},
			{"data": 'btn'},
			{"data": 'id'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('hidetd');
        }
	});
	$('#tableCariItem tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const nama = td.eq(0).text();
		const unit = td.eq(1).text();
		const id = td.eq(3).text();
		const item = document.querySelector('#namaItem');
		item.value = nama;
		item.dataset.id = id;
		document.querySelector('#unit').value = unit;
		renderFormValBtnKonfirmasi();
		$('#modalCariItem').modal('hide');
	});
}
function dataTableDetail() {
	const form = {noReq: document.querySelector('#noReq').value}
	$('#tableItem').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getdetail`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'jumlah'},
			{"data": 'btn'}
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
function dataTableCariItem() {
	$('#tableCariItem').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallitem`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'satuanBesar'},
			{"data": 'stokTerbesar'},
			{"data": 'satuanKecil'},
			{"data": 'stock'},
			{"data": 'btn'},
			{"data": 'id'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        	$('td', row).eq(6).addClass('hidetd');
        }
	});
	$('#tableCariItem tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const idItem = td.eq(6).text();
		const namaItem = td.eq(0).text();
		const stock = td.eq(4).text();
		if(stock > 0) {
			document.querySelector('#idItem').value = idItem;
			document.querySelector('#namaItem').value = namaItem;
			document.querySelector('#stock').value = stock;
			$('#modalCariItem').modal('hide');
		} else {
			showSnackError('Stock barang habis');
		}
	});
}
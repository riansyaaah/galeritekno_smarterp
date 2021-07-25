function dataTableCariItem() {
	$('#tableCariItem').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getitem`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'itemmaster'},
			{"data": 'stock'},
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
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('hidetd');
        }
	});
	$('#tableCariItem tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const item = td.eq(0).text();
		const stock = td.eq(1).text();
		const satuan = td.eq(2).text();
		const id = td.eq(4).text();
		document.querySelector('#namaItem').value = item;
		const stokHTML = document.querySelector('#stock');
		stokHTML.value = `${stock} ${satuan}`;
		stokHTML.dataset.stok = stock;
		document.querySelector('#idItem').value = id;
		document.querySelector('#jumlah').removeAttribute('readonly');
		$('#modalCariItem').modal('hide');
	});
}
function dataTableItem() {
	const form = {noPO: document.querySelector('#noPO').value}
	$('#tableItem').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getpo`,
			dataSrc: 'data',
			type: 'POST',
			dataType: 'json',
			data: form
		},
		columns: [
			{"data": 'namaItem'},
			{"data": 'jumlah'},
			{"data": 'satuan'},
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
function dataTableCariPO() {
	$('#tableCariPO').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallpo`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'noPO'},
			{"data": 'tglPO'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        }
	});
	$('#tableCariPO tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const no = td.eq(0).text();
		const tgl = td.eq(1).text();
		const noPO = document.querySelector('#noPO');
		const tglPO = document.querySelector('#tglPO');
		noPO.value = no;
		tglPO.value = tgl;
		noPO.setAttribute('readonly', '');
		tglPO.setAttribute('readonly', '');
		const btnAddItem = document.querySelector('#btnAddItem').removeAttribute('disabled');
		const btnPrint = document.querySelector('#btnPrint').removeAttribute('disabled');
		const btnSelesai = document.querySelector('#btnSelesai').removeAttribute('disabled');
		dataTableItem();
		$('#modalCariPO').modal('hide');
	});
}
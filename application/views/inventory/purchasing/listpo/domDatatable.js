function dataTablePO() {
	$('#tablePO').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getallpo`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'tglPO'},
			{"data": 'noPO'},
			{"data": 'nama'},
			{"data": 'status'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
}
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
function dataTablePODetailSelesai() {
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
			}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [2, 3]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-right');
        	$('td', row).eq(3).addClass('text-right');
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
		renderBtnKonfirmasi();
		$('#modalCariItem').modal('hide');
	});
}
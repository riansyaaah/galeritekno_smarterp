function dataShift() {
	const form = {
		start_date: document.querySelector('#start_date').value,
		end_date: document.querySelector('#end_date').value,
		shift_id: document.querySelector('#shift_id').value
	}
	$('#tableShift').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getshift`,
			type: 'post',
            dataType: 'json',
			dataSrc: 'data',
			data: form
		},
		columns: [
			{"data": 'no'},
			{"data": 'date'},
			{"data": 'id_personel'},
			{"data": 'nama'},
			{"data": 'department'},
			{"data": 'position'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [6]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
            $('td', row).eq(2).addClass('text-center');
            $('td', row).eq(6).addClass('text-center');
        }
	});
}
function dataAdd() {
	const form = {
		start_date: document.querySelector('#start_date').value,
		end_date: document.querySelector('#end_date').value
	}
	$('#tableAdd').dataTable({
		destroy: true,
		bInfo: false,
		ajax: {
			url: `${baseUrl}getallstaff`,
			type: 'post',
            dataType: 'json',
			dataSrc: 'data',
			data: form
		},
		columns: [
			{"data": 'id_personel'},
			{"data": 'nama'},
			{"data": 'department'},
			{"data": 'position'},
			{"data": 'check'},
			{"data": 'id'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [5]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(5).addClass('hidetd');
        }
	});
}
function dataEdit() {
	const form = {
		date: document.querySelector('#tanggal').value,
		idPersonel: document.querySelector('#idPersonel').value
	}
	$('#tableCariStaff').dataTable({
		destroy: true,
		bInfo: false,
		ajax: {
			url: `${baseUrl}getstaffhaveshift`,
			type: 'post',
            dataType: 'json',
			dataSrc: 'data',
			data: form
		},
		columns: [
			{"data": 'id_personel'},
			{"data": 'nama'},
			{"data": 'department'},
			{"data": 'position'},
			{"data": 'btn'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
	$('#tableCariStaff tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const idPersonel = td.eq(0).text();
		const nama = td.eq(1).text();
		document.querySelector('#idPersonel').value = idPersonel;
		document.querySelector('#nama').value = nama;
		$('#modalCariStaff').modal('hide');
	});
}
function dataTableCariPeriode() {
	$('#tableCariPeriode').dataTable({
		destroy: true,
		bInfo: false,
		ajax: {
			url: `${baseUrl}getbulandepan`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'no'},
			{"data": 'month'},
			{"data": 'year'},
			{"data": 'id'},
			{"data": 'btn'},
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
	$('#tableCariPeriode tbody').on('click', 'button', function() {
		const td = $(this).closest('tr').children('td');
		const id = td.eq(3).text();
		document.querySelector('#period').value = id;
		renderWorkHour(id);
		$('#modalCariPeriode').modal('hide');
	});
}
function dataTableWorkHour(periode) {
	const form = {periode: periode}
	$('#tableWorkHour').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getworkhour`,
			type: 'post',
            dataType: 'json',
			dataSrc: 'data',
			data: form
		},
		columns: [
			{"data": 'id_personel'},
			{"data": 'nama'},
			{"data": 'department'},
			{"data": 'position'},
			{"data": 'jamKerja'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
}
function renderTable() {
	document.querySelector('#konten').innerHTML = tableHTML();
	const periodeDepan = document.querySelector('#period').value;
	if(periodeDepan == 'Not Set') document.querySelector('#btnAdd').disabled = true
	dataShift();
}
function renderShift() {
	fetch(`${baseUrl}getallshift`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(shift => {
				html += `<option value="${shift.id}">
					Shift ${shift.shift} | ${shift.day} (${shift.start_time} - ${shift.end_time})
				</option>`;
			});
			document.querySelector('#shift_id').innerHTML = html;
		})
		.catch(e => console.log(e));
}
function renderStartChange() {
	const endDate = document.querySelector('#end_date');
	const shift = document.querySelector('#shift_id').value;
	(endDate.value && shift)? renderTable() : endDate.removeAttribute('readonly');
}
function renderEndChange() {
	const shift = document.querySelector('#shift_id');
	const startDate = document.querySelector('#start_date').value;
	if(shift.value && startDate) {
		renderTable();
	} else {
		renderShift();
		shift.removeAttribute('disabled');
	}
}
function renderShiftChange() {
	const startDate = document.querySelector('#start_date').value;
	const endDate = document.querySelector('#end_date').value;
	if(startDate && endDate) renderTable();
}
function renderModalDelete(id) {
	fetch(`${baseUrl}getshiftbyid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formDelete(res.data);
			const html = modalElement('modalDelete', 'btnDelete', 'Delete', body)
			document.querySelector('#modal').innerHTML = html;
			$('#modalDelete').modal();
		})
		.catch(e => console.log(e));
}
function renderModalAdd() {
	const body = formAdd();
	const html = modalElement('modalAdd', 'btnSaveAdd', 'Add', body, 'modal-lg');
	document.querySelector('#modal').innerHTML = html;
	dataAdd();
	$('#modalAdd').modal();
}
function renderModalSwap(id) {
	fetch(`${baseUrl}getshiftbyid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formSwap(res.data);
			const html = modalElement('modalSwap', 'btnSwap', 'Swap', body)
			document.querySelector('#modal').innerHTML = html;
			$('#modalSwap').modal();
		})
		.catch(e => console.log(e));
}
function renderModalEdit(id) {
	fetch(`${baseUrl}getshiftbyid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formEdit(res.data);
			const html = modalElement('modalEdit', 'btnEdit', 'Edit', body)
			document.querySelector('#modal').innerHTML = html;
			renderShiftEdit(res.data.shift_id);
			$('#modalEdit').modal();
		})
		.catch(e => console.log(e));
}
function renderShiftEdit(idShift) {
	fetch(`${baseUrl}getallshift`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(shift => {
				html += `<option value="${shift.id}" ${(shift.id == idShift)? 'selected' : ''}>
					Shift ${shift.shift} | ${shift.day} (${shift.start_time} - ${shift.end_time})
				</option>`;				
			});
			document.querySelector('#shift').innerHTML = html;
		})
		.catch(e => console.log(e));
}
function renderModalCariStaff() {
	const body = tableCariStaff();
	const html = modalElement('modalCariStaff', '', 'Staff', body, 'modal-lg')
	document.querySelector('#modalStaff').innerHTML = html;
	dataEdit();
	$('#modalCariStaff').modal();
}
function renderModalCariPeriode() {
	const body = formCariPeriode();
	const html = modalElement('modalCariPeriode', '', 'Periode', body, 'modal-lg')
	document.querySelector('#modal').innerHTML = html;
	dataTableCariPeriode();
	$('#modalCariPeriode').modal();
}
function renderAksiBerhasilInput(res, btn, idModal) {
	if (res.status_json) {
		showSnackSuccess(res.remarks);
		renderTable();
		const period = document.querySelector('#period').value;
		renderWorkHour(period);
		$(`#${idModal}`).modal('hide');
	} else {
		btn.innerHTML = 'Gagal, Coba lagi';
		btn.disabled = false;
		showSnackError(res.remarks);
	}
}
function renderAksiGagalInput(e, btn) {
	btn.innerHTML = 'Gagal, Coba lagi';
	btn.disabled = false;
	console.log(e);
}
function renderWorkHour(period) {
	document.querySelector('#workHour').innerHTML = workHourHTML();
	dataTableWorkHour(period);
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function showSnackSuccess(text) {
	iziToast.success({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
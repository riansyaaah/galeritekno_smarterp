function renderAwal() {
	document.querySelector('#form').innerHTML = formHTML();
	document.querySelector('#konten').innerHTML = tableUtamaHTML();
	generateNoPO();
}
function generateNoPO() {
	fetch(`${baseUrl}generatenopo`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noPO').value = res.data;
		})
		.catch(e => console.log(e));
}
function renderModalCariPO() {
	const body = tableCariPOHTML();
	const html = modalHTML('modalCariPO', 'Internal PO', '', body, 'modal-lg', 0);
	document.querySelector('#modal').innerHTML = html;
	dataTableCariPO();
	$('#modalCariPO').modal();
}
function renderAddItemModal() {
	const body = formAddItem('tambah');
	const html = modalHTML('modalAddItem', 'Tambah Item', 'btnSaveItem', body);
	document.querySelector('#modal').innerHTML = html;
	renderUnit();
	$('#modalAddItem').modal();
}
function renderCariItemModal() {
	const html = modalHTML('modalCariItem', 'Item', '', tableCariItem(), 'modal-lg', 0);
	document.querySelector('#modalItem').innerHTML = html;
	dataTableCariItem();
	$('#modalCariItem').modal();
}
function renderPrint() {
	const noPO = document.querySelector('#noPO').value;
	document.querySelector('#print').innerHTML = anchorPrint(noPO);
	document.querySelector('#btnCetak').click();
}
function renderUnit(idUnit = '') {
	fetch(`${baseUrl}getallunit`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data.id}" ${(idUnit == data.id)? 'selected' : ''}>${data.unit}</option>`;
			});
			document.querySelector('#unit').innerHTML = html;
		});
}
function renderEditItemModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddItem('edit', res.data);
			const html = modalHTML('modalAddItem', 'Edit Item', 'btnSaveItem', body);
			document.querySelector('#modal').innerHTML = html;
			renderUnit(res.data.idUnit);
			document.querySelector('#idItem').value = res.data.idItemmaster;
			$('#modalAddItem').modal();
		})
		.catch(e => console.log(e));
}
function renderHapusItemModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formDeleteItem(res.data)
			const html = modalHTML('modalDeleteItem', 'Delete Item', 'btnDeleteItem', body);
			document.querySelector('#modal').innerHTML = html;
			$('#modalDeleteItem').modal();
		})
		.catch(e => console.log(e));
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function successitem(text, fungsi, idModal) {
	Swal.fire({
		title: 'Info',
		html: text,
		type: "success",
		confirmButtonText: 'Ok',
		confirmButtonColor: "#46b654",
	}).then((result) => {
		fungsi();
		if(idModal) $(`#${idModal}`).modal('hide');
	})
}
function renderUtama() {
	document.querySelector('#form').innerHTML = formHTML();
	document.querySelector('#konten').innerHTML = tableItemHTML();
	fetch(`${baseUrl}generatenoreq`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noReq').value = res.data;
		})
		.catch(e => console.log(e));
}
function successSaveReq() {
	document.querySelector('#btnAddItem').removeAttribute('disabled');
	document.querySelector('#btnSelesai').removeAttribute('disabled');
	document.querySelector('#noReq').setAttribute('readonly', '');
	dataTableDetail();
}
function renderAddModal() {
	const body = formInputItemModal(1);
	const html = modalHTML('modalAddItem', 'Tambah Item', body, 'btnConfirmItem');
	document.querySelector('#modal').innerHTML = html;
	fetch(`${baseUrl}getallitem`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data.id}">${data.itemmaster}</option>`;
			});
			document.querySelector('#namaItem').innerHTML = html;
		})
		.catch(e => console.log(e));
	$('#namaItem').select2({dropdownParent: $('#modalAddItem')});
	$('#modalAddItem').modal();
	$('#namaItem').on('select2:select', e => {
		fetch(`${baseUrl}getitem?id=${e.target.value}`)
			.then(res => res.json())
			.then(res => {
				document.querySelector('#stock').value = res.data.stock;
			});
	});
}
function renderEditModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			console.log(res.data);
			const body = formInputItemModal(2, res.data);
			const html = modalHTML('modalAddItem', 'Edit Item', body, 'btnConfirmItem');
			document.querySelector('#modal').innerHTML = html;
			const namaItem = document.querySelector('#namaItem');
			fetch(`${baseUrl}getallitem`)
				.then(response => response.json())
				.then(response => {
					if(!res.data.idItemMaster) {
						let option = `<option value="${res.data.namaItem}">${res.data.namaItem}</option>`;
						response.data.forEach(item => {
							option += `<option value="${item.id}">${item.itemmaster}</option>`;
						});
						namaItem.innerHTML = option;
					} else {
						let option = '';
						response.data.forEach(item => {
							option += `<option value="${item.id}" ${(item.id == res.data.idItemMaster)? 'selected' : ''}>${item.itemmaster}</option>`;
						});
						namaItem.innerHTML = option;
					}
				})
				.catch(e => console.log(e));
			$('#namaItem').select2({dropdownParent: $('#modalAddItem')});
			fetch(`${baseUrl}getitembyname?nama=${res.data.namaItem}`)
				.then(res => res.json())
				.then(res => {
					document.querySelector('#stock').value = (res.data)? res.data.stock : 0;
				});
			$('#modalAddItem').modal();
		})
		.catch(e => console.log(e));
}
function renderHapusModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formDeleteItemModal(res.data);
			const html = modalHTML('modalDeleteItem', 'Delete Item', body, 'btnDeleteItem');
			document.querySelector('#modal').innerHTML = html;
			$('#modalDeleteItem').modal();
		})
		.catch(e => console.log(e));
}
function renderCariReqModal() {
	const body = tableCariReq();
	const html = modalHTML('modalCariReq', 'Request', body, '', 'modal-lg');
	document.querySelector('#modal').innerHTML = html;
	dataTableCariReq();
	$('#modalCariReq').modal();
}
function renderCariItemModal() {
	const body = tableCariItemHTML();
	const html = modalHTML('modalCariItem', 'Cari Item', body, '', 'modal-xl');
	document.querySelector('#modal2').innerHTML = html;
	dataTableCariItem();
	$('#modalCariItem').modal();
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function success(aksi, text, idModal) {
	Swal.fire({
		title: 'Info',
		html: text,
		type: "success",
		confirmButtonText: 'Ok',
		confirmButtonColor: "#46b654",
	}).then((result) => {
		aksi();
		if(idModal) $(`#${idModal}`).modal('hide');
	})
}
function renderInput(target) {
	fetch(`${baseUrl}getitembyname?nama=${target.innerHTML}`)
		.then(res => res.json())
		.then(res => {
			console.log(res);
			target.innerHTML = `<div class="form-group" id="edit${res.data.id}">
				<input type="hidden" id="idEditDblClick" value="${res.data.id}">
				<select id="editDblClick" class="form-control input-sm select2">
					<option value="">Oke</option>
				</select>
			</div>`;
		});
	$('#editDblClick').select2({dropdownParent: $(`#tableItem`)});
}
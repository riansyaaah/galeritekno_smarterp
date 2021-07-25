function renderUtama() {
	document.querySelector('#form').innerHTML = '';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#konten').innerHTML = recommendTableHTML();
	dataTableRequest();
}
function renderAddNew() {
	document.querySelector('#form').innerHTML = formAddNewHTML();
	document.querySelector('#konten').innerHTML = detailTableHTML();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#noRecommend').disabled = true;
	document.querySelector('#tglRecommend').value = sekarang;
	generateNoRecommend();
	document.querySelector('#btnSave').disabled = false;
}
function renderEditDetailModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddHTML(2, res.data);
			const html = modalHTML('modalAddDetail', 'Edit', body, 'btnSaveDetail', 'modal-xl');
			document.querySelector('#modal').innerHTML = html;
			$('#modalAddDetail').modal();
		})
		.catch(e => console.log(e));
}
function renderDeleteDetailModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formHapusHTML(res.data);
			const html = modalHTML('modalHapus', 'Hapus', body, 'btnHapus');
			document.querySelector('#modal').innerHTML = html;
			$('#modalHapus').modal();
		})
		.catch(e => console.log(e));
}
function renderBtnSave() {
	const noRecommend = document.querySelector('#noRecommend').value;
	const tglRecommend = document.querySelector('#tglRecommend').value;
	btnSave = document.querySelector('#btnSave');
	(noRecommend && tglRecommend)? btnSave.removeAttribute('disabled') : btnSave.setAttribute('disabled', '');
}
function generateNoRecommend() {
	fetch(`${baseUrl}generatenorecommend`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noRecommend').value = res.data;
		})
		.catch(e => console.log(e));
}
function aksiSaveRecommend() {
	document.querySelector('#btnSave').setAttribute('disabled', '');
	document.querySelector('#btnAdd').removeAttribute('disabled');
	document.querySelector('#btnPrint').removeAttribute('disabled');
	dataTableDetail();
}
function renderAddModal() {
	const body = formAddHTML(1);
	const html = modalHTML('modalAddDetail', 'Tambah', body, 'btnSaveDetail', 'modal-xl');
	document.querySelector('#modal').innerHTML = html;
	$('#modalAddDetail').modal();
}
function aksiSaveDetail() {
	document.querySelector('#noRecommend').setAttribute('readonly', '');
	document.querySelector('#tglRecommend').setAttribute('readonly', '');
	document.querySelector('#btnSave').setAttribute('disabled', '');
	document.querySelector('#btnAdd').removeAttribute('disabled');
	document.querySelector('#btnPrint').removeAttribute('disabled');
	offsetBtnAdd();
	dataTableDetail();
	$('#modalAddDetail').modal('hide');
}
function renderAksiHapus() {
	document.querySelector('#noRecommend').setAttribute('readonly', '');
	document.querySelector('#tglRecommend').setAttribute('readonly', '');
	document.querySelector('#btnSave').setAttribute('disabled', '');
	document.querySelector('#btnAdd').removeAttribute('disabled');
	document.querySelector('#btnPrint').removeAttribute('disabled');
	offsetBtnAdd();
	dataTableDetail();
	$('#modalHapus').modal('hide');
}
function renderDetail(id) {
	fetch(`${baseUrl}getrecommend?id=${id}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#form').innerHTML = formAddNewHTML(res.data);
			document.querySelector('#konten').innerHTML = detailTableHTML();
			document.querySelector('#modal').innerHTML = '';
			offsetBtnAdd();
			dataTableDetail();
		})
		.catch(e => console.log(e));
}
function offsetBtnAdd() {
	const noRecommend = document.querySelector('#noRecommend').value;
	const btnAdd = document.querySelector('#btnAdd');
	fetch(`${baseUrl}getdetail?noRecommend=${noRecommend}`)
		.then(res => res.json())
		.then(res => {
			(res.data.length < 3)? btnAdd.removeAttribute('disabled') : btnAdd.setAttribute('disabled', '');
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
function success(text, aksi) {
	Swal.fire({
		title: 'Info',
		html: text,
		type: "success",
		confirmButtonText: 'Ok',
		confirmButtonColor: "#46b654",
	}).then((result) => {
		aksi();
	})
}
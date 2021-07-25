function renderUtama() {
	document.querySelector('#header').innerHTML = formUtamaHTML();
	document.querySelector('#konten').innerHTML = '';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
}
function generateNoPO(tanggal) {
	fetch(`${baseUrl}generatenopo?tanggal=${tanggal}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noPO').value = res.data;
		})
		.catch(e => console.log(e));
}
function renderPODetail() {
	document.querySelector('#konten').innerHTML = tablePODetailHTML();
	dataTablePODetail();
}
function renderAksiSaveAddItem() {
	renderPODetail();
	$('#modalAddItem').modal('hide');
}
function renderModalCariSupplier() {
	const body = tableCariSupplierHTML();
	const html = modalHTML('modalCariSupplier', 'Supplier', '', body, 'modal-lg', 0);
	document.querySelector('#modal').innerHTML = html;
	dataTableCariSupplier();
	$('#modalCariSupplier').modal();
}
function renderActivateBtnSave() {
	const tanggal = document.querySelector('#tanggal').value;
	const btnSavePO = document.querySelector('#btnSavePO');
	(tanggal)? btnSavePO.removeAttribute('disabled') : btnSavePO.setAttribute('disabled', '');
}
function renderSavePO() {
	const btnSavePO = document.querySelector('#btnSavePO');
	btnSavePO.innerHTML = '<i class="fa fa-plus"></i> Simpan PO';
	btnSavePO.disabled = true;
	document.querySelector('#btnAdd').disabled = false;
	document.querySelector('#btnPrint').disabled = false;
	document.querySelector('#btnSelesai').disabled = false;
	document.querySelector('#tanggal').disabled = true;
	document.querySelector('#konten').innerHTML = tablePODetailHTML();
	dataTablePODetail();
}
function renderAddItemModal() {
	const body = formAddItemHTML();
	const html = modalHTML('modalAddItem', 'Tambah Item', 'btnSaveAddItem', body);
	document.querySelector('#modal').innerHTML = html;
	$('#modalAddItem').modal();
}
function renderEditModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddItemHTML(res.data);
			const html = modalHTML('modalAddItem', 'Edit Item', 'btnSaveAddItem', body);
			document.querySelector('#modal').innerHTML = html;
			$('#modalAddItem').modal();
		})
		.catch(e => console.log(e));
}
function renderCariItemModal() {
	const body = cariItemHTML();
	const html = modalHTML('modalCariItem', 'Item', '', body, 'modal-lg');
	document.querySelector('#modal2').innerHTML = html;
	dataTableCariItem();
	$('#modalCariItem').modal();
}
function renderFormValBtnKonfirmasi() {
	const namaItem = document.querySelector('#namaItem').value;
	const jumlah = document.querySelector('#jumlah').value;
	const hargaSatuan = document.querySelector('#hargaSatuan').value;
	const btnSaveAddItem = document.querySelector('#btnSaveAddItem');
	(namaItem && jumlah && hargaSatuan)? btnSaveAddItem.removeAttribute('disabled') : btnSaveAddItem.setAttribute('disabled', '');
}
function renderPrint() {
	const data = {
		noPO: document.querySelector('#noPO').value,
		tipeSupplier: document.querySelector('#kodeSupplier').dataset.tipe
	}
	window.open(`${baseUrl}print?${getParam(data)}`);
}
function renderHapusModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formHapus(res.data);
			const html = modalHTML('modalHapus', 'Hapus', 'btnHapus', body, '', 1);
			document.querySelector('#modal').innerHTML = html;
			document.querySelector('#btnHapus').disabled = false;
			$('#modalHapus').modal();
		})
		.catch(e => console.log(e))
}
function renderDeleteDetail() {
	const btn = document.querySelector('#btnHapus');
	btn.innerHTML = 'Konfirmasi';
	btn.disabled = false;
	document.querySelector('#btnAdd').disabled = false;
	document.querySelector('#btnPrint').disabled = false;
	document.querySelector('#btnSelesai').disabled = false;
	document.querySelector('#tanggal').disabled = true;
	document.querySelector('#konten').innerHTML = tablePODetailHTML();
	dataTablePODetail();
	$('#modalHapus').modal('hide');
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
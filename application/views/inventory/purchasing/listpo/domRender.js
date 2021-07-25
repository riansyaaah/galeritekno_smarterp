function renderUtama() {
	document.querySelector('#header').innerHTML = '';
	document.querySelector('#konten').innerHTML = tablePOHTML();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	dataTablePO();
}
function renderDetail(id, tipe) {
	fetch(`${baseUrl}getpo?idPO=${id}&tipeSupplier=${tipe}`)
		.then(res => res.json())
		.then(res => {
			if(res.data.approvedBy) {
				document.querySelector('#header').innerHTML = headerHTML(res.data, tipe);
				document.querySelector('#konten').innerHTML = tablePODetailSelesaiHTML();
				document.querySelector('#modal').innerHTML = '';
				document.querySelector('#modal2').innerHTML = '';
				document.querySelector('#btnAdd').style.display = 'none';
				document.querySelector('#btnPrint').style.display = 'none';
				dataTablePODetailSelesai();
			} else {
				document.querySelector('#header').innerHTML = headerHTML(res.data, tipe);
				document.querySelector('#konten').innerHTML = tablePODetailHTML();
				document.querySelector('#modal').innerHTML = '';
				document.querySelector('#modal2').innerHTML = '';
				dataTablePODetail();
			}
		})
		.then(e => console.log(e));
}
function renderAddItemModal() {
	const body = formAddItemHTML(data = '');
	const html = modalHTML('modalAddItem', 'Tambah Item', 'btnAddItem', body);
	document.querySelector('#modal').innerHTML = html;
	document.querySelector('#btnAddItem').disabled = true;
	$('#modalAddItem').modal();
}
function renderEditModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddItemHTML(res.data);
			const html = modalHTML('modalAddItem', 'Edit Item', 'btnAddItem', body);
			document.querySelector('#modal').innerHTML = html;
			$('#modalAddItem').modal();
		})
		.catch(e => console.log(e));
}
function renderHapusModal(id) {
	fetch(`${baseUrl}getdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formHapusHTML(res.data);
			const html = modalHTML('modalHapusItem', 'Hapus Item', 'btnHapusItem', body);
			document.querySelector('#modal').innerHTML = html;
			$('#modalHapusItem').modal();
		})
		.catch(e => console.log(e));
}
function renderCariItemModal() {
	const body = tableCariItemHTML();
	const html = modalHTML('modalCariItem', 'Item Master', '', body, 'modal-lg', 0);
	document.querySelector('#modal2').innerHTML = html;
	dataTableCariItem();
	$('#modalCariItem').modal();
}
function renderBtnKonfirmasi() {
	const namaItem = document.querySelector('#namaItem').value;
	const jumlah = document.querySelector('#jumlah').value;
	const hargaSatuan = document.querySelector('#hargaSatuan').value;
	const btn = document.querySelector('#btnAddItem');
	(namaItem && jumlah && hargaSatuan)? btn.removeAttribute('disabled') : btn.setAttribute('disabled', '');
}
function renderAksiSaveItem() {
	const btn = document.querySelector('#btnAddItem');
	btn.innerHTML = 'Konfirmasi';
	btn.disabled = false;
	dataTablePODetail();
	$('#modalAddItem').modal('hide');
}
function renderAksiHapusItem() {
	const btn = document.querySelector('#btnHapusItem');
	btn.innerHTML = 'Konfirmasi';
	btn.disabled = false;
	dataTablePODetail();
	$('#modalHapusItem').modal('hide');
}
function renderPrint() {
	const data = {
		noPO: document.querySelector('#noPO').value,
		tipeSupplier: document.querySelector('#supplier').dataset.tipe
	}
	window.open(`${baseUrl}print?${getParam(data)}`);
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
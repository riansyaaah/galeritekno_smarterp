function getParam(data) {
	return new URLSearchParams(data).toString();
}
function inputItem(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		status: document.querySelector('#status').value,
		kategori: document.querySelector('#kategori').value,
		namaItem: document.querySelector('#namaItem').value,
		unitTerbesar: document.querySelector('#unitTerbesar').value,
		unitTerkecil: document.querySelector('#unitTerkecil').value,
		jmlTerkecil: document.querySelector('#jmlTerkecil').value,
		fixed: document.querySelector('#fixed').value,
		bhp: document.querySelector('#bhp').value,
		accountNo: document.querySelector('#accountNo').value
	}
	data = getParam(data);
	console.log(`${baseUrl}saveitem?${data}`);
	sendData(btn, `saveitem?${data}`, renderAksiSaveItem);
}
function hapusItem(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const id = document.querySelector('#idHapus').value;
	sendData(btn, `hapusitem?id=${id}`, renderAksiDeleteItem);
}
function sendData(btn, url, aksi) {
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, aksi);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = true;
			}
		})
		.catch(e => {
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = true;
		});
}
function renderAksiSaveItem() {
	$('#modalAddItem').modal('hide');
	renderAwal();
}
function renderAksiDeleteItem() {
	$('#modalHapusItem').modal('hide');
	renderAwal();
}
function getParam(data) {
	return new URLSearchParams(data).toString();
}
function inputItem(btn) {
	let data = {
		status: document.querySelector('#status').value,
		noPO: document.querySelector('#noPO').value,
		rev: document.querySelector('#rev').value,
		jumlah: document.querySelector('#jumlah').value,
		hargaSatuan: document.querySelector('#hargaSatuan').value,
		idItemMaster: document.querySelector('#namaItem').dataset.id
	}
	data = getParam(data);
	sendData(btn, `saveadditem?${data}`, renderAksiSaveItem);
}
function inputDeleteItem(btn) {
	let data = {
		id:document.querySelector('#idHapus').value,
		rev: document.querySelector('#rev').value
	}
	data = getParam(data);
	sendData(btn, `hapusdetail?${data}`, renderAksiHapusItem);
}
function sendData(btn, url, aksi) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, aksi);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;
			}
		})
		.catch(e => {
			console.log(e);
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
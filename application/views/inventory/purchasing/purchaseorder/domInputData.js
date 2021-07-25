function getParam(data) {
	return new URLSearchParams(data).toString();
}
function saveAddItem(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let form = {
		status: document.querySelector('#status').value,
		noPO: document.querySelector('#noPO').value,
		idItemMaster: document.querySelector('#namaItem').dataset.id,
		jumlah: document.querySelector('#jumlah').value,
		hargaSatuan: document.querySelector('#hargaSatuan').value
	}
	form = getParam(form);
	fetch(`${baseUrl}saveadditem?${form}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiSaveAddItem);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;
			}
		})
		.catch(e => {
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
function savePO(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let form = {
		kodeSupplier: document.querySelector('#kodeSupplier').value,
		tipeSupplier: document.querySelector('#kodeSupplier').dataset.tipe,
		noPO: document.querySelector('#noPO').value,
		tanggal: document.querySelector('#tanggal').value,
	}
	form = getParam(form);
	fetch(`${baseUrl}savepo?${form}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderSavePO);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;
			}
		})
		.catch(e => {
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
function hapusDetail(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const id = document.querySelector('#idHapus').value;
	fetch(`${baseUrl}hapusdetail?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderDeleteDetail);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;	
			}
		})
		.catch(e => {
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
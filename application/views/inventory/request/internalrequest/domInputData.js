function getParam(data) {
	return new URLSearchParams(data).toString();
}
function saveReq(btn) {
	let form = {
		noReq: document.querySelector('#noReq').value
	}
	namaBtn = '<i class="fa fa-save"></i> Simpan Request';
	console.log(`${baseUrl}savereq?${form}`)
	inputData(form, 'savereq', btn, namaBtn, successSaveReq);
}
function inputDetail(btn, idModal) {
	const jumlah = document.querySelector('#jumlah');
	const spek = document.querySelector('#spek');
	let form = {
		noReq: document.querySelector('#noReq').value,
		status: document.querySelector('#status').value,
		idDetail: document.querySelector('#idDetail').value,
		idItem: document.querySelector('#namaItem').value,
		jumlah: jumlah.value,
		ket: document.querySelector('#ket').value,
		spek: spek.value
	}
	if(!form.jumlah) {
		jumlah.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.spek) {
		spek.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else {
		const namaBtn = 'Konfirmasi';
		inputData(form, 'savedetail', btn, namaBtn, dataTableDetail, idModal);
	}
}
function deleteDetail(btn) {
	let form = {
		noReq: document.querySelector('#noReq').value,
		status: document.querySelector('#status').value,
		idDetail: document.querySelector('#idDetail').value
	}
	const namaBtn = 'Konfirmasi';
	inputData(form, 'savedetail', btn, namaBtn, dataTableDetail, 'modalDeleteItem');
}
function inputData(data, url, btn, namaBtn, aksi, idModal = null) {
	btn.innerHTML = 'Loading...';
	btn.setAttribute('disabled', '');
	data = getParam(data);
	console.log(`${baseUrl+url}?${data}`);
	fetch(`${baseUrl+url}?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(aksi, res.remarks, idModal);
				btn.innerHTML = namaBtn;
				btn.setAttribute('disabled', '');
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.removeAttribute('disabled');
			}
		})
		.catch(e => {
			console.log(e);
			btn.innerHTML = 'Coba Lagi';
			btn.removeAttribute('disabled');
		});
}
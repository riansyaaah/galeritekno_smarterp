function inputRegistrasi(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		status: document.querySelector('#status').value,
		nik: document.querySelector('#nik').value,
    	nomorPegawai: document.querySelector('#nomorPegawai').value,
    	namaLengkap: document.querySelector('#namaLengkap').value,
    	customRadio: document.querySelector('input[name="customRadio"]').value,
    	tempatLahir: document.querySelector('#tempatLahir').value,
    	tanggalLahir: document.querySelector('#tanggalLahir').value,
    	nomorHP: document.querySelector('#nomorHP').value,
    	email: document.querySelector('#email').value,
    	alamat: document.querySelector('#alamat').value,
    	picMarketing: document.querySelector('#picMarketing').value,
    	cabang: document.querySelector('#cabang').value,
    	jenisLayanan: document.querySelector('#jenisLayanan').value,
    	paketPemeriksaan: document.querySelector('#paketPemeriksaan').value,
    	tanggalKunjungan: document.querySelector('#tanggalKunjungan').value,
    	jamKunjungan: document.querySelector('#jamKunjungan').value,
    	faskesAsal: document.querySelector('#faskesAsal').value,
    	instansi: document.querySelector('#instansi').value,
    	caraPembayaran: document.querySelector('#caraPembayaran').value,
    	catatan: document.querySelector('#catatan').value,
    	tanggalRegistrasi: document.querySelector('#tanggalRegistrasi').value,
    	idpayment: document.querySelector('#idpayment').value
	}
	data = getParam(data);
	fetch(`${baseUrl}simpanregistrasi?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilInput);
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
function getParam(data) {
	return new URLSearchParams(data).toString();
}
function inputHapusPeserta(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const id = document.querySelector('#idHapus').value;
	fetch(`${baseUrl}hapuspeserta?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilInput);
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
function inputReschedule(btn) {
	btn.innerHTML = 'Loading...'
	btn.disabled = true;
	let form = {
		id: document.querySelector('#idReschedule').value,
		tanggalkunjungan: document.querySelector('#tglKunjungan').value,
		jamkunjungan: document.querySelector('#jmKunjungan').value
	}
	form = getParam(form);
	fetch(`${baseUrl}actionreschedule?${form}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilReschedule);
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
function inputHadirSemua(btn) {
	btn.innerHTML = 'Loading...'
	btn.disabled = true;
	const idpayment = document.querySelector('#idpayment').value;
	fetch(`${baseUrl}actionhadirsemua?idpayment=${idpayment}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilHadirSemua);
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
function inputDeletePeserta(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const id = document.querySelector('#idHapus').value;
	fetch(`${baseUrl}hapuspeserta?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilDeletePeserta);
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
function inputHadirSingle(btn) {
	btn.innerHTML = 'Loading...'
	btn.disabled = true;
	const id = document.querySelector('#idHadirSingle').value;
	console.log(`${baseUrl}actionhadirsingle?id=${id}`);
	fetch(`${baseUrl}actionhadirsingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilHadirSingle);
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
function inputEditPeserta(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		status: document.querySelector('#status').value,
		idEdit: document.querySelector('#idEdit').value,
		nik: document.querySelector('#nik').value,
    	nomorPegawai: document.querySelector('#nomorPegawai').value,
    	namaLengkap: document.querySelector('#namaLengkap').value,
    	customRadio: document.querySelector('input[name="customRadio"]').value,
    	tempatLahir: document.querySelector('#tempatLahir').value,
    	tanggalLahir: document.querySelector('#tanggalLahir').value,
    	nomorHP: document.querySelector('#nomorHP').value,
    	email: document.querySelector('#email').value,
    	alamat: document.querySelector('#alamat').value,
    	picMarketing: document.querySelector('#picMarketing').value,
    	cabang: document.querySelector('#cabang').value,
    	jenisLayanan: document.querySelector('#jenisLayanan').value,
    	paketPemeriksaan: document.querySelector('#paketPemeriksaan').value,
    	tanggalKunjungan: document.querySelector('#tanggalKunjungan').value,
    	jamKunjungan: document.querySelector('#jamKunjungan').value,
    	faskesAsal: document.querySelector('#faskesAsal').value,
    	instansi: document.querySelector('#instansi').value,
    	caraPembayaran: document.querySelector('#caraPembayaran').value,
    	catatan: document.querySelector('#catatan').value,
    	tanggalRegistrasi: document.querySelector('#tanggalRegistrasi').value,
    	idpayment: document.querySelector('#idpayment').value
	}
	data = getParam(data);
	fetch(`${baseUrl}simpanregistrasi?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, renderAksiBerhasilEdit);
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
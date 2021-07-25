function renderUtama() {
	document.querySelector('#header').innerHTML = formUtamaHTML();
	document.querySelector('#konten').innerHTML = '';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	renderNoRequest();
	document.querySelector('#tanggal').value = sekarang;
}
function renderNoRequest() {
	fetch(`${baseUrl}generatenoreq`)
		.then(res => res.json()) 
		.then(res => {
			document.querySelector('#noReq').value = res.data;
		})
		.catch(e => console.log(e));
}
function renderBtnBuatRequest() {
	const noReq = document.querySelector('#noReq').value;
	const tanggal = document.querySelector('#tanggal').value;
	const jamAmbil = document.querySelector('#jamAmbil').value;
	const lokasi = document.querySelector('#lokasi').value;
	const totalPasien = document.querySelector('#totalPasien').value;
	const keperluan = document.querySelector('#keperluan').value;
	const btnBuatRequest = document.querySelector('#btnBuatRequest');
	(noReq && tanggal && jamAmbil && lokasi && totalPasien && keperluan)? btnBuatRequest.removeAttribute('disabled') : btnBuatRequest.setAttribute('disabled', '');
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
function renderAksiBuatRequest() {
	const btnBuatRequest = document.querySelector('#btnBuatRequest');
	btnBuatRequest.disabled = true;
	btnBuatRequest.innerHTML = '<i class="fas fa-file-alt"></i> Buat Request';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	document.querySelector('#konten').innerHTML = tableDetail();
	document.querySelector('#tanggal').disabled = true;
	document.querySelector('#jamAmbil').disabled = true;
	document.querySelector('#lokasi').disabled = true;
	document.querySelector('#totalPasien').disabled = true;
	document.querySelector('#keperluan').disabled = true;
	dataTableDetail();
}
function renderBtnSaveRequest(data) {
	const param = [];
	const btnSaveRequest = document.querySelector('#btnSaveRequest');
	data.forEach(data => {
		const input = document.querySelector(`#jumlah${data.id}`);
		if(!input.value) {
			btnSaveRequest.disabled = true;
		} else {
			param.push(1);
		}
	});
	(data.length == param.length)? btnSaveRequest.removeAttribute('disabled') : btnSaveRequest.setAttribute('disabled', '');
}
function renderAksiSaveRequest() {
	const btnSaveRequest = document.querySelector('#btnSaveRequest');
	btnSaveRequest.disabled = true;
	btnSaveRequest.innerHTML = '<i class="fa fa-plus"></i> Simpan Request';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	document.querySelector('#konten').innerHTML = tableDetail();
	document.querySelector('#btnSelesai').disabled = false;
	dataTableTransactionDetail()
}
function getParam(data) {
	return new URLSearchParams(data).toString();
}
function inputBuatRequest(btn) {
	let data = {
		 noReq: document.querySelector('#noReq').value,
		 tanggal: document.querySelector('#tanggal').value,
		 jamAmbil: document.querySelector('#jamAmbil').value,
		 lokasi: document.querySelector('#lokasi').value,
		 totalPasien: document.querySelector('#totalPasien').value,
		 keperluan: document.querySelector('#keperluan').value
	}
	data = getParam(data);
	inputData(btn, `buatrequest?${data}`, renderAksiBuatRequest);
}
function inputSaveRequest(btn) {
	const noReq = document.querySelector('#noReq').value;
	const table = $('#tableDetail').DataTable();
	const data = `noReq=${noReq}&${table.$('input').serialize()}`;
	inputData(btn, `saverequest?${data}`, renderAksiSaveRequest);
}
function inputData(btn, url, aksi) {
	btn.innerHTML = 'Loading';
	btn.disabled = true;
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, aksi);
			} else {
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;
			}
		})
		.catch(e => {
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
function renderGagal(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function renderSukses(text, aksi) {
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
function renderUtama() {
	document.querySelector('#header').innerHTML = headerHTML();
	document.querySelector('#konten').innerHTML = tableUtamaHTML();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	renderFilter();
	dataTableUtama();
}
function renderFormDataPemeriksaan(data) {
	let html = null;
	if(data.barcode == 'RA') {
		html = dataPemeriksaanRAHTML(data);
	} else if(data.barcode == 'SA') {
		html = dataPemeriksaanSAHTML(data);
	} else if(data.barcode == 'SM') {
		html = dataPemeriksaanSMHTML(data);
	} else {
		html = dataPemeriksaanHTML(data);
	}
	return html;
}
function renderSelectBarcode(data) {
	if(data.barcode == 'RA') {

	} else if(data.barcode == 'SA') {

	} else if(data.barcode == 'SM') {

	} else {
		renderSelect(data.ncov, 'nCov', `getncov`);
		renderSelect(data.fam, 'nGene', `getngene`);
		renderSelect(data.rox, 'orf1ab', `getORF1ab`);
	}
}
function renderProses(id) {
	fetch(`${baseUrl}getlaboratorium?id=${id}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#header').innerHTML = headerProsesHTML();
			document.querySelector('#konten').innerHTML = kontenProsesHTML(res.data, renderFormDataPemeriksaan(res.data));
			document.querySelector('#modal').innerHTML = '';
			document.querySelector('#modal2').innerHTML = '';
			renderSelectId(res.data.idcabang, 'nama', 'cabang', `getcabang?id=${res.data.idcabang}`);
			renderSelectId(res.data.idinstansi, 'instansi', 'instansi', `getinstansi?idcabang=${res.data.idcabang}`);
			renderSelectId(res.data.idfaskes, 'namafaskes', 'faskesAsal', `getfaskes?idcabang=${res.data.idcabang}`);
			renderSelectId(res.data.idjenispemeriksaandetail, 'detailketerangan', 'jenisPemeriksaan', `getjenispemeriksaan?idcabang=${res.data.idcabang}`);
			renderSelect(res.data.jenissample, 'jenisSample', `getjenissample`);
			renderSelectId(res.data.iddokter, 'namadokter', 'dokterPemeriksa', `getdokter?idcabang=${res.data.idcabang}`);
			renderSelectId(res.data.idpetugas, 'namapetugas', 'petugasPemeriksa', `getpetugas?idcabang=${res.data.idcabang}`);
			renderSelect(res.data.statustransaksi, 'statusPemeriksaan', `getstatuspemeriksaan`);
			renderSelectId(res.data.statuskirimhasil, 'status', 'statusKirimHasil', 'getstatuskirimhasil');
			renderSelectBarcode(res.data);
		})
		.catch(e => console.log(e));
}
function renderFilter() {
	renderSelectFilter('instansi', 'filterInstansi', 'getallinstansi');
	renderSelectFilter('nama', 'filterPICMarketing', 'getallpicmarketing');
	renderSelectFilter('namaPaket', 'filterPaketPemeriksaan', 'getallpaketpemeriksaan');
	renderSelectFilter('namaCabang', 'filterCabang', 'getallcabang');
	renderSelectTanpaPilihFilter('status', 'filterStatusHasil', 'getallstatus');
}
function renderSelectTanpaPilihFilter(key, target, url) {
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			let html = '';
			res.data.forEach(data => {
				html += `<option value="${data.id}">${data[key]}</option>`;
			});
			document.querySelector(`#${target}`).innerHTML = html
		})
		.catch(e => console.log(e));
}
function renderSelectFilter(key, target, url) {
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data.id}">${data[key]}</option>`;
			});
			document.querySelector(`#${target}`).innerHTML = html
		})
		.catch(e => console.log(e));
}
function renderSelectId(id, key, target, url) {
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data.id}" ${(data.id == id)? 'selected' : ''}>${data[key]}</option>`;
			});
			document.querySelector(`#${target}`).innerHTML = html
		})
		.catch(e => console.log(e));
}
function renderSelect(param, target, url) {
	fetch(baseUrl+url)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data}" ${(data == param)? 'selected' : ''}>${data}</option>`;
			});
			document.querySelector(`#${target}`).innerHTML = html
		})
		.catch(e => console.log(e));
}
function renderAksiBerhasilEdit() {
	const id = document.querySelector('#idProses').value;
	renderProses(id);
	const btn = document.querySelector('#btnSimpan');
	btn.innerHTML = 'Simpan';
	btn.disabled = false;
}
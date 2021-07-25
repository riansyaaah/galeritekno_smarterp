function inputData(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const idProses = document.querySelector('#idProses');
	let data = {
		id: 						htmlSpecialChars(idProses.value),
		barcode: 					htmlSpecialChars(idProses.dataset.barcode),
		tanggalregistrasi: 			htmlSpecialChars(document.querySelector('#tanggalRegistrasi').value),
		nomorregistrasi: 			htmlSpecialChars(document.querySelector('#nomorRegistrasi').value),
		nik: 						htmlSpecialChars(document.querySelector('#nik').value),
		nopassport: 				htmlSpecialChars(document.querySelector('#noPassport').value),
		nationality: 				htmlSpecialChars(document.querySelector('#nationality').value),
		nama: 						htmlSpecialChars(document.querySelector('#namaLengkap').value),
		jeniskelamin: 				htmlSpecialChars(document.querySelector('#jenisKelamin').value),
		tempatlahir: 				htmlSpecialChars(document.querySelector('#tempatLahir').value),
		tanggallahir: 				htmlSpecialChars(document.querySelector('#tanggalLahir').value),
		nomorhp: 					htmlSpecialChars(document.querySelector('#nomorHP').value),
		email: 						htmlSpecialChars(document.querySelector('#email').value),
		alamat: 					htmlSpecialChars(document.querySelector('#alamat').value),
		cabang: 					htmlSpecialChars(document.querySelector('#cabang').value),
		instansi: 					htmlSpecialChars(document.querySelector('#instansi').value),
		idfaskes: 					htmlSpecialChars(document.querySelector('#faskesAsal').value),
		catatan: 					htmlSpecialChars(document.querySelector('#catatan').value),
		tanggalkunjungan: 			htmlSpecialChars(document.querySelector('#tanggalKunjungan').value),
		jamkunjungan: 				htmlSpecialChars(document.querySelector('#jamKunjungan').value),
		jenispemeriksaan: 			htmlSpecialChars(document.querySelector('#jenisPemeriksaan').value),
		tanggalsampling: 			htmlSpecialChars(document.querySelector('#tanggalAmbilSampling').value),
		jamsampling: 				htmlSpecialChars(document.querySelector('#jamAmbilSampling').value),
		tanggalperiksa: 			htmlSpecialChars(document.querySelector('#tanggalPeriksaSampling').value),
		jamperiksa: 				htmlSpecialChars(document.querySelector('#jamPeriksaSampling').value),
		tanggalselesai: 			htmlSpecialChars(document.querySelector('#tanggalSelesai').value),
		jamselesai: 				htmlSpecialChars(document.querySelector('#jamSelesaiSampling').value),
		jenissample: 				htmlSpecialChars(document.querySelector('#jenisSample').value),
		iddokter: 					htmlSpecialChars(document.querySelector('#dokterPemeriksa').value),
		idpetugas: 					htmlSpecialChars(document.querySelector('#petugasPemeriksa').value),
		statustransaksi: 			htmlSpecialChars(document.querySelector('#statusPemeriksaan').value),
		statuskirimhasil: 			htmlSpecialChars(document.querySelector('#statusKirimHasil').value)
	}
	if(data.barcode == 'RA') {
		data.IgM = htmlSpecialChars(document.querySelector('#IgM').value);
		data.IgG = htmlSpecialChars(document.querySelector('#IgG').value);
	} else if(data.barcode == 'SA') {
		data.antigen = htmlSpecialChars(document.querySelector('#antigen').value);
	} else if(data.barcode == 'SM') {
		data.swabMolecular = htmlSpecialChars(document.querySelector('#swabMolecular').value);
	} else {
		data.nCov = htmlSpecialChars(document.querySelector('#nCov').value);
		data.nGene = htmlSpecialChars(document.querySelector('#nGene').value);
		data.orf1ab = htmlSpecialChars(document.querySelector('#orf1ab').value);
		data.ic = htmlSpecialChars(document.querySelector('#ic').value);
	}
	fetch(`${baseUrl}actionedithasil`, {
		method: 'post',
		headers : {'Content-type' : 'application/json'},
		body: JSON.stringify(data)
	})
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				renderSukses(res.remarks, renderAksiBerhasilEdit);
			} else {
				renderGagal(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;
			}
		})
		.catch(e => {
			renderGagal(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
function htmlSpecialChars(text) {
	return text
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;");
}
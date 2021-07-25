document.querySelector('#header').addEventListener('click', e => {
	if(e.target.classList.contains('addPeserta')) {
		renderAddPesertaModal();
	} else if(e.target.classList.contains('tombolDetailKembali')) {
		renderUtama();
	} else if(e.target.id == 'btnFilter') {
		dataTableFilter();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnAddPeserta') {
		inputRegistrasi(e.target);
	} else if(e.target.id == 'btnHapusPeserta') {
		inputHapusPeserta(e.target);
	} else if(e.target.id == 'btnReschedule') {
		inputReschedule(e.target);
	} else if(e.target.id == 'btnConfirmHadirSemua') {
		inputHadirSemua(e.target);
	} else if(e.target.id == 'btnDeletePeserta') {
		inputDeletePeserta(e.target);
	} else if(e.target.id == 'btnHadir') {
		inputHadirSingle(e.target);
	} else if(e.target.id == 'btnEditPeserta') {
		inputEditPeserta(e.target);
	}
});
document.querySelector('#modal').addEventListener('keyup', e => {
	if(e.target.id == 'namaLengkap') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'tempatLahir') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'nomorHP') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'alamat') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'nik') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'nomorPegawai') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'catatan') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'email') {
		renderBtnRegistrasi();
	}
});
document.querySelector('#modal').addEventListener('change', e => {
	if(e.target.id == 'customRadio') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'picMarketing') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'cabang') {
		renderPaketPemeriksaan(e.target.value);
		renderFaskes(e.target.value);
		renderInstansi(e.target.value);
		renderBtnRegistrasi();
	} else if(e.target.id == 'jenisLayanan') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'paketPemeriksaan') {
		renderJamKunjungan(e.target.value);
		renderBtnRegistrasi();
	} else if(e.target.id == 'tanggalKunjungan') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'jamKunjungan') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'faskesAsal') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'instansi') {
		renderBtnRegistrasi();
	} else if(e.target.id == 'caraPembayaran') {
		renderBtnRegistrasi();
	}
});
document.querySelector('#konten').addEventListener('click', e => {
	if(e.target.classList.contains('btnHadirSemua')) {
		renderHadirSemuaModal();
	} else if(e.target.classList.contains('btnCetakKwitansi')) {
		renderCetakKwitansi();
	}
});
document.querySelector('#card2').addEventListener('click', e => {
	if(e.target.classList.contains('addPesertaDetail')) {
		renderAddPesertaDetailModal();
	}
});
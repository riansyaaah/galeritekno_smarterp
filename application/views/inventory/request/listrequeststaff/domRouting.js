document.querySelector('#header').addEventListener('click', e => {
	if(e.target.id == 'btnBack') {
		renderRequest();
	}
});
document.querySelector('#header').addEventListener('change', e => {
	if(e.target.id == 'tanggal') {
		// formValKeluar();
	}
});
document.querySelector('#konten').addEventListener('click', e => {
	if(e.target.id == 'btnConfirm') {
		confirmValidation(e.target);
	} else if(e.target.id == 'btnDelivery') {
		inputKeluar(e.target);
	} else if(e.target.id == 'btnKonfirmasi') {
		inputSwaber(e.target);
	}
});
document.querySelector('#konten').addEventListener('keyup', e => {
	if(levelUser == 1) {
		// formValKeluar();
	} else if(levelUser == 3) {
		formValSwaber();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btConfirmValidasi') {
		inputValidasi(e.target);
	} else if(e.target.id == 'btnKonfirmasiUbah') {
		inputUbah(e.target);
	} else if(e.target.id == 'btnKonfirmasiTambah') {
		inputTambah(e.target);
	} else if(e.target.id == 'btnKonfirmasiEditJumlah') {
		inputEditJumlah(e.target);
	}
});
document.querySelector('#konten').addEventListener('change', e => {
	if(e.target.id == 'cekAll') {
		(e.target.checked)? e.target.removeAttribute('checked') : e.target.setAttribute('checked', '');
		renderCekAll(e.target);
	}
});
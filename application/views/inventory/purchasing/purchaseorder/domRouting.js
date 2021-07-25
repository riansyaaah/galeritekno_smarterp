document.querySelector('#header').addEventListener('click', e => {
	if(e.target.id == 'btnCariSupplier') {
		renderModalCariSupplier();
	} else if(e.target.id == 'btnSavePO') {
		savePO(e.target);
	} else if(e.target.id == 'btnAdd') {
		renderAddItemModal();
	} else if(e.target.id == 'btnSelesai') {
		renderUtama();
	} else if(e.target.id == 'btnPrint') {
		renderPrint();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnSaveAddItem') {
		saveAddItem(e.target);
	} else if(e.target.id == 'btnCariItem') {
		renderCariItemModal();
	} else if(e.target.id == 'btnHapus') {
		hapusDetail(e.target);
	}
});
document.querySelector('#header').addEventListener('change', e => {
	if(e.target.id == 'tanggal') {
		generateNoPO(e.target.value);
		renderActivateBtnSave();
	}
});
document.querySelector('#modal').addEventListener('keyup', e => {
	if(e.target.id == 'jumlah' || e.target.id == 'hargaSatuan') {
		renderFormValBtnKonfirmasi();
	}
});
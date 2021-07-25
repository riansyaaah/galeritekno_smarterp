document.querySelector('#konten').addEventListener('click', e => {
	if(e.target.id == 'btnSavePO') {
		savePO(e.target);
	} else if(e.target.id == 'btnSelesai') {
		renderAwal();
	} else if(e.target.id == 'btnAddItem') {
		renderAddItemModal();
	} else if(e.target.id == 'btnPrint') {
		renderPrint();
	} else if(e.target.id == 'btnKonfirmasi') {
		formValidationAccPO(e.target);
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnCariItem') {
		renderCariItemModal();
	} else if(e.target.id == 'btnSaveItem') {
		saveItem(e.target);
	} else if(e.target.id == 'btnDeleteItem') {
		deleteItem(e.target);
	}
});
document.querySelector('#modal').addEventListener('change', e => {
	if(e.target.id == 'jumlah') e.target.classList.remove('is-invalid');
});
document.querySelector('#form').addEventListener('click', e => {
	if(e.target.id == 'btnCariPO') {
		renderModalCariPO();
	}
});
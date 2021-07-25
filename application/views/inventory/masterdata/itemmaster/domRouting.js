document.querySelector('#header').addEventListener('click', e => {
	if(e.target.id == 'btnAdd') {
		renderAddModal();
	}
});
document.querySelector('#modal').addEventListener('change', e => {
	if(e.target.id == 'kategori') {
		renderBtnSaveItem();
	} else if(e.target.id == 'unitTerbesar') {
		renderBtnSaveItem();
	} else if(e.target.id == 'unitTerkecil') {
		renderBtnSaveItem();
	} else if(e.target.id == 'fixed') {
		renderSifat(e.target.value);
	} else if(e.target.id == 'bhp') {
		renderBtnSaveItem();
	}
});
document.querySelector('#modal').addEventListener('keyup', e => {
	if(e.target.id == 'namaItem') {
		renderBtnSaveItem();
	} else if(e.target.id == 'jmlTerkecil') {
		renderBtnSaveItem();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnSaveItem') {
		inputItem(e.target);
	} else if(e.target.id == 'btnHapusItem') {
		hapusItem(e.target);
	} else if(e.target.id == 'btnCariAccountNo') {
		renderCariAccountNoModal();
	}
});
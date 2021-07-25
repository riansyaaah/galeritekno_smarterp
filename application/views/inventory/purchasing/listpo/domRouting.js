document.querySelector('#header').addEventListener('click', e => {
	if(e.target.id == 'btnBack') {
		renderUtama();
	} else if(e.target.id == 'btnAdd') {
		renderAddItemModal();
	} else if(e.target.id == 'btnPrint') {
		renderPrint();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnCariItem') {
		renderCariItemModal();
	} else if(e.target.id == 'btnAddItem') {
		inputItem(e.target);
	} else if(e.target.id == 'btnHapusItem') {
		inputDeleteItem(e.target);
	}
});
document.querySelector('#modal').addEventListener('keyup', e => {
	if(e.target.id == 'jumlah') {
		renderBtnKonfirmasi();
	} else if(e.target.id == 'hargaSatuan') {
		renderBtnKonfirmasi();
	}
});
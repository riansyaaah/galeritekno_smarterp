document.querySelector('#form').addEventListener('change', e => {
	if(e.target.id == 'tglRecommend') {
		renderBtnSave();
	}
});
document.querySelector('#form').addEventListener('click', e => {
	if(e.target.id == 'btnBack') {
		renderUtama();
	} else if(e.target.id == 'btnSave') {
		saveRecommend(e.target);
	} else if(e.target.id == 'btnAdd') {
		renderAddModal();
	} else if(e.target.id == 'btnPrint') {
		renderPrint();
	}
});
document.querySelector('#konten').addEventListener('click', e => {
	if(e.target.id == 'btnNew') {
		renderAddNew();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnSaveDetail') {
		saveDetailValidasi(e.target);
	} else if(e.target.id == 'btnHapus') {
		hapusDetail(e.target);
	}
});
function renderPrint() {
	const noRecommend = document.querySelector('#noRecommend').value;
	window.open(`${baseUrl}print?noRecommend=${noRecommend}`);
}
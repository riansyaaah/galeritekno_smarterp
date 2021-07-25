document.querySelector('#header').addEventListener('click', e => {
	if(e.target.classList.contains('btnKembali')) {
		renderUtama();
	} else if(e.target.id == 'btnFilter') {
		
	}
});
document.querySelector('#konten').addEventListener('click', e => {
	if(e.target.id == 'btnSimpan') {
		inputData(e.target);
	}
});
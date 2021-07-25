document.querySelector('#modal').addEventListener('change', e => {
	if(e.target.id == 'tanggal') {
		renderBtnSaveOpname();
	}
});
document.querySelector('#modal').addEventListener('keyup', e => {
	if(e.target.id == 'realStock') {
		const idItem = document.querySelector('#idItem').value;
		fetch(`${baseUrl}getitem?id=${idItem}`)
			.then(res => res.json())
			.then(res => {
				const stockBesar = Math.ceil(parseInt(e.target.value)/parseInt(res.data.jumlahTerkecil));
				const element = document.querySelector('#stockBesar');
				element.value = '';
				element.value = (Number.isNaN(stockBesar))? '' : stockBesar;
			})
			.catch(e => console.log(e));
		renderBtnSaveOpname();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnSaveOpname') {
		inputSaveOpname(e.target);
	}
});
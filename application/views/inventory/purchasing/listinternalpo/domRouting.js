document.querySelector('#header').addEventListener('click', e => {
	if(e.target.id == 'btnBack') {
		renderTablePO();
	} else if(e.target.id == 'btnKonfirmasi') {
		inputKonfirmasi(e.target);
	}
});
document.querySelector('#konten').addEventListener('keyup', e => {
	const noPO = document.querySelector('#noPO').value;
	fetch(`${baseUrl}getpodetail?noPO=${noPO}`)
		.then(res => res.json())
		.then(res => renderBtnKonfirmasi(res.data))
		.catch(e => console.log(e));
});
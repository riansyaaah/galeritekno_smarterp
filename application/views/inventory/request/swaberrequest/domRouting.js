document.querySelector('#header').addEventListener('keyup', e => {
	if(e.target.id == 'jamAmbil') {
		renderBtnBuatRequest();
	} else if(e.target.id == 'lokasi') {
		renderBtnBuatRequest();
	} else if(e.target.id == 'totalPasien') {
		renderBtnBuatRequest();
	} else if(e.target.id == 'keperluan') {
		renderBtnBuatRequest();
	}
});
document.querySelector('#header').addEventListener('change', e => {
	if(e.target.id == 'keperluan') {
		renderBtnBuatRequest();
	}
});
document.querySelector('#header').addEventListener('click', e => {
	if(e.target.id == 'btnBuatRequest') {
		inputBuatRequest(e.target);
	} else if(e.target.id == 'btnSaveRequest') {
		inputSaveRequest(e.target);
	} else if(e.target.id == 'btnSelesai') {
		renderUtama();
	}
});
document.querySelector('#konten').addEventListener('keyup', e => {
	fetch(`${baseUrl}getallitemlab`)
		.then(res => res.json())
		.then(res => {
			renderBtnSaveRequest(res.data);
		})
		.catch(e => console.log(e));
});
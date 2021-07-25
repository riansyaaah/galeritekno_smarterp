function getParam(data) {
	return new URLSearchParams(data).toString();
}
function inputSaveOpname(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		idItem: document.querySelector('#idItem').value,
		tanggal: document.querySelector('#tanggal').value,
		realStock: document.querySelector('#realStock').value
	}
	data = getParam(data);
	fetch(`${baseUrl}saveopname?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks, aksiSaveOpname);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.disabled = false;
			}
		})
		.catch(e => {
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.disabled = false;
		});
}
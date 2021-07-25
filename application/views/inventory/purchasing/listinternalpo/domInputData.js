function inputKonfirmasi(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const table = $('#tablePODetail').DataTable();
	const noPO = document.querySelector('#noPO').value
	form = `noPO=${noPO}&${table.$('input').serialize()}`;
	fetch(`${baseUrl}konfirmasi?${form}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				btn.innerHTML = '<i className="fa fa-check-circle"></i> Konfirmasi';
				btn.disabled = false;
				success(res.remarks, renderTablePO);
			} else {
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				showSnackError(res.remarks);
			}
		})
		.catch(e => {
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			showSnackError(e);
		});
}
function renderTablePO() {
	document.querySelector('#header').innerHTML = '';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#konten').innerHTML = tablePOHTML();
	dataTablePO();
}
function renderDetail(id) {
	fetch(`${baseUrl}getpo?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if(levelUser == 1) {
				if(res.data.checkedBy) {
					renderDetailGADiproses(res.data);
				} else {
					renderDetailGAMenunggu(res.data);
				}
			} else {
				if(res.data.checkedBy) {
					renderDetailManagerDiproses(res.data);
				} else {
					renderDetailManagerMenunggu(res.data);
				}
			}
		})
		.catch(e => console.log(e));
}
function renderDetailManagerDiproses(data) {
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#header').innerHTML = headerDetailHTML(data.noPO);
	document.querySelector('#konten').innerHTML = tablePODetailHTML();
	document.querySelector('#btnKonfirmasi').style.display = 'none';
	dataTablePODetailManagerDiproses(data.noPO);
}
function renderDetailManagerMenunggu(data) {
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#header').innerHTML = headerDetailHTML(data.noPO);
	document.querySelector('#konten').innerHTML = tablePODetailManagerMenunggulHTML();
	document.querySelector('#btnKonfirmasi').style.display = 'none';
	dataTablePODetailManagerMenunggu(data.noPO);
}
function renderDetailGADiproses(data) {
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#header').innerHTML = headerDetailHTML(data.noPO);
	document.querySelector('#konten').innerHTML = tablePODetailHTML();
	document.querySelector('#btnKonfirmasi').style.display = 'none';
	dataTablePODetail(data.noPO);
}
function renderDetailGAMenunggu(data) {
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#header').innerHTML = headerDetailHTML(data.noPO);
	document.querySelector('#konten').innerHTML = tablePODetailHTML();
	dataTablePODetail(data.noPO);
}
function renderBtnKonfirmasi(data) {
	if(data.length > 0) {
		const param = [];
		const param2 = [];
		data.forEach(data => {
			const jml = document.querySelector(`#jmlReview${data.id}`);
			if(!jml.value) {
				document.querySelector('#btnKonfirmasi').disabled = true
			} else {
				param.push(1);
			}
		});
		btnKonfirmasi = document.querySelector('#btnKonfirmasi');
		(data.length == param.length)? btnKonfirmasi.removeAttribute('disabled') : btnKonfirmasi.setAttribute('disabled', '');
	}
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function success(text, fungsi) {
	Swal.fire({
		title: 'Info',
		html: text,
		type: "success",
		confirmButtonText: 'Ok',
		confirmButtonColor: "#46b654",
	}).then((result) => {
		fungsi();
	})
}
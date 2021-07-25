function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function success(text, modal) {
	Swal.fire({
		title: 'Info',
		html: text,
		type: "success",
		confirmButtonText: 'Ok',
		confirmButtonColor: "#46b654",
	}).then((result) => {
		aksi();
	})
}
function renderUtama() {
	document.querySelector('#form').innerHTML = '';
	document.querySelector('#konten').innerHTML = tableUtama();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	dataTableUtama();
}
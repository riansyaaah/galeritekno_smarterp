function getParam(data) {
	return new URLSearchParams(data).toString();
}
// function confirmValidation(btn) {
// 	const noReq = document.querySelector('#noReq').value;
// 	fetch(`${baseUrl}getrequestdetail?noReq=${noReq}`)
// 		.then(res => res.json())
// 		.then(res => {
// 			if(res.data.length > 0) {
// 				const param = [];
// 				res.data.forEach(data => {
// 					const input = document.querySelector(`#input${data.id}`);
// 					if(input.value) {
// 						input.classList.remove('is-invalid');
// 						param.push(input);
// 					} else {
// 						input.classList.add('is-invalid');
// 						showSnackError('Harus diisi');
// 					}
// 				});
// 				if(param.length == res.data.length) {
// 					inputConfirm(btn, noReq);
// 				}
// 			}
// 		})
// 		.catch(e => console.log(e));
// }
// function inputConfirm(btn, noReq) {
// 	btn.innerHTML= 'Loading...';
// 	btn.setAttribute('disabled', '');
// 	const table = $('#tableReqDetail').DataTable();
// 	const data = table.$('input').serialize();
// 	fetch(`${baseUrl}confirm?noReq=${noReq}&${data}`)
// 		.then(res => res.json())
// 		.then(res => {
// 			if(res.status_json) {
// 				btn.innerHTML = 'Konfirmasi';
// 				btn.setAttribute('disabled', '');
// 				success(res.remarks);
// 			} else {
// 				showSnackError(res.remarks);
// 				btn.innerHTML = 'Coba Lagi';
// 				btn.removeAttribute('disabled');
// 			}
// 		})
// 		.catch(e => {
// 			showSnackError(e);
// 			btn.innerHTML = 'Coba Lagi';
// 			btn.removeAttribute('disabled');
// 		});
// }
function confirmValidation(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const noReq = document.querySelector('#noReq').value;
	fetch(`${baseUrl}confirm?noReq=${noReq}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks);
				btn.innerHTML = 'Konfirmasi';
				btn.disabled = false;
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
function formValKeluar() {
	const noReq = document.querySelector('#noReq').value;
	fetch(`${baseUrl}getrequestdetail?noReq=${noReq}`)
		.then(res => res.json())
		.then(res => {
			if(res.data.length > 0) {
				const param = [];
				res.data.forEach(data => {
					const input = document.querySelector(`#keluar${data.id}`).value;
					if(input) param.push(1);
				});
				const tanggal = document.querySelector('#tanggal').value;
				const btnDelivery = document.querySelector('#btnDelivery');
				if(param.length == res.data.length && tanggal) {
					btnDelivery.disabled = false;
				} else {
					btnDelivery.disabled = true;
				}
			}
		})
		.catch(e => console.log(e));
}
function inputKeluar(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let form = {
		noReq: document.querySelector('#noReq').value,
		noTransaksi: document.querySelector('#noTransaksi').value,
		tanggal: document.querySelector('#tanggal').value
	}
	const table = $('#tableReqDetail').DataTable();
	form = `${getParam(form)}&${table.$('.keluar').serialize()}`;
	console.log(`${baseUrl}keluar?${form}`);
	fetch(`${baseUrl}keluar?${form}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				success(res.remarks);
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
function formValSwaber() {
	const noReq = document.querySelector('#noReq').value;
	fetch(`${baseUrl}getdetailswaber?noReq=${noReq}`)
		.then(res => res.json())
		.then(res => {
			if(res.data.length > 0) {
				renderBtnKonfirmasi(res.data);
			}
		})
		.catch(e => console.log(e));
}
function inputSwaber(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true
	const noReq = document.querySelector('#noReq').value;
	const table = $('#tableSwaber').DataTable();
	fetch(`${baseUrl}konfirmasiswaber?noReq=${noReq}&${table.$('input').serialize()}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				btn.innerHTML = '<i class="fa fa-check-circle"></i> Konfirmasi';
				btn.disabled = false;
				success(res.remarks);
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
function inputValidasi(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		noReq: document.querySelector('#noReq').value,
		nama: document.querySelector('#namaItemValidasi').value,
		jumlah: document.querySelector('#jumlahItemValidasi').value
	}
	data = getParam(data);
	fetch(`${baseUrl}simpanvalidasi?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				sukses(res.remarks, renderAksiValidasi);
				btn.innerHTML = 'Konfirmasi';
				btn.disabled = false;
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
function inputUbah(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		idDetail: document.querySelector('#idUbah').value,
		idItem: document.querySelector('#namaItemUbah').value
	}
	data = getParam(data);
	fetch(`${baseUrl}simpanubah?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				sukses(res.remarks, renderAksiUbah);
				btn.innerHTML = 'Konfirmasi';
				btn.disabled = false;
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
function inputTambah(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		idDetail: document.querySelector('#idDetail').value,
		namaItem: document.querySelector('#namaItem').value,
		kategori: document.querySelector('#kategori').value,
		unitTerbesar: document.querySelector('#unitTerbesar').value,
		jmlTerbesar: document.querySelector('#jmlTerbesar').value,
		unitTerkecil: document.querySelector('#unitTerkecil').value,
		jmlTerkecil: document.querySelector('#jmlTerkecil').value
	}
	data = getParam(data);
	fetch(`${baseUrl}simpantambah?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				sukses(res.remarks, renderAksiTambah);
				btn.innerHTML = 'Konfirmasi';
				btn.disabled = false;
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
		})
}
function inputEditJumlah(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let data = {
		idEditJumlah: document.querySelector('#idEditJumlah').value,
		jmlEditJumlah: document.querySelector('#jmlEditJumlah').value
	}
	data = getParam(data);
	fetch(`${baseUrl}simpaneditjumlah?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				sukses(res.remarks, renderAksiEditJumlah);
				btn.innerHTML = 'Konfirmasi';
				btn.disabled = false;
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
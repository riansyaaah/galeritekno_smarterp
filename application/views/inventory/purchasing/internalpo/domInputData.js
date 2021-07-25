function deleteItem(btn) {
	const data = {id: document.querySelector('#idDelete').value}
	inputData('deleteitem', data, btn, 'modalDeleteItem');
}
function savePO(btn) {
	btn.innerHTML = 'Loading...';
	btn.setAttribute('disabled', '');
	let data = {
		noPO: document.querySelector('#noPO').value
	}
	inputData('savepo', data, btn);
}
function saveItem(btn) {
	const namaItem = document.querySelector('#namaItem');
	const formItem = document.querySelector('#formItem');
	const jumlah = document.querySelector('#jumlah');
	const unit = document.querySelector('#unit');
	const form = {
		noPO: document.querySelector('#noPO').value,
		jumlah: jumlah.value,
		status: formItem.dataset.status,
		unit: unit.value,
		namaItem: namaItem.value,
		idDetail: formItem.dataset.iddetail,
		ket: document.querySelector('#ket').value
	}
	if(!form.jumlah) {
		jumlah.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.unit) {
		unit.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.namaItem) {
		namaItem.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else {
		inputData('additem', form, btn, 'modalAddItem');
	}
}
function inputData(url, data, btn, idModal = null) {
	btn.innerHTML = 'Loading...';
	btn.setAttribute('disabled', '');
	data = new URLSearchParams(data).toString();
	fetch(`${baseUrl+url}?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				btn.innerHTML = 'Simpan PO';
				document.querySelector('#btnAddItem').disabled = false;
				document.querySelector('#btnPrint').disabled = false;
				document.querySelector('#btnSelesai').disabled = false;
				document.querySelector('#noPO').setAttribute('readonly', '');
				successitem(res.remarks, dataTableItem, idModal);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Gagal, coba lagi';
				btn.removeAttribute('disabled');
			}
		})
		.catch(e => {
			console.log(e);
			btn.innerHTML = 'Gagal, coba lagi';
			btn.removeAttribute('disabled');
		});
}
function formValidationAccPO(btn) {
	const noPO = document.querySelector('#noPO').value;
	fetch(`${baseUrl}getpo?noPO=${noPO}`)
		.then(res => res.json())
		.then(res => {
			if(res.data.length > 0) {
				const param = [];
				res.data.forEach(data => {
					const input = document.querySelector(`#jmlAktual${data.id}`);
					if(!input.value) {
						input.classList.add('is-invalid');
						showSnackError('Harus diisi');
					} else {
						input.classList.remove('is-invalid');
						param.push(input);
					}
				});
				if(param.length > 0) {
					inputAccPO(noPO, btn);
				}
			}
		})
		.catch(e => console.log(e));
}
function inputAccPO(noPO, btn) {
	btn.innerHTML = 'Loading...';
	btn.setAttribute('disabled', '');
	const table = $('#tableItem').DataTable();
	const data = table.$('input').serialize();
	fetch(`${baseUrl}accpo?noPO=${noPO}&${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				btn.innerHTML = '<i class="fa fa-check-circle"></i> Terkonfirmasi';
				document.querySelector('#btnAddItem').disabled = true;
				document.querySelector('#btnPrint').disabled = false;
				document.querySelector('#btnSelesai').disabled = false;
				btn.disabled = true;
				document.querySelector('#noPO').setAttribute('readonly', '');
				document.querySelector('#tglPO').setAttribute('readonly', '');
				successitem(res.remarks, dataTableItem);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Gagal, coba lagi';
				btn.removeAttribute('disabled');
			}
		})
		.catch(e => {
			btn.innerHTML = 'Gagal, coba lagi';
			btn.removeAttribute('disabled');
		});
}
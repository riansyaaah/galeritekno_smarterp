function renderRequest() {
	document.querySelector('#header').innerHTML = '';
	document.querySelector('#konten').innerHTML = tableRequest();
	document.querySelector('#modal').innerHTML = '';
	dataTableRequest();
}
function renderDetail(id, tipe = 0) {
	fetch(`${baseUrl}getrequest?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if(levelUser == 1) {
				if(res.data.approvedBy) {
					renderSelesai(res.data);
				} else if(res.data.checkedBy) {
					renderDiproses(res.data);
				} else {
					renderMenunggu(res.data);
				}
			} else if(levelUser == 2) {
				if(res.data.approvedBy) {
					renderSelesaiManager(res.data);
				} else if(res.data.checkedBy) {
					renderDiprosesManager(res.data);
				} else {
					renderMenunggu(res.data);
				}
			} else {
				if(tipe == 1) {
					renderSwaber(res.data);
				} else {
					if(res.data.approvedBy) {
						renderSelesaiStaff(res.data);
					} else if(res.data.checkedBy) {
						renderDiprosesStaff(res.data);
					} else {
						renderDetailStaff(res.data);
					}
				}
			}
		})
		.catch(e => console.log(e));
}
function renderSwaber(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq);
	document.querySelector('#konten').innerHTML = tableSwaberHTML();
	dataTableSwaber();
}
function renderSelesaiStaff(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq, 1);
	document.querySelector('#konten').innerHTML = tableDetailKeluarHTML();
	document.querySelector('#btnConfirm').style.display = 'none';
	document.querySelector('#btnDelivery').style.display = 'none';
	fetch(`${baseUrl}gettransaction?noTransaction=${data.noTransaction}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noTransaksi').value = res.data.noTransaction;
			const tanggal = document.querySelector('#tanggal');
			tanggal.value = res.data.tglTransaction
			tanggal.disabled = true;
		})
		.catch(e => console.log(e));
	dataTableRequestDetailKeluarStaff();
}
function renderDiprosesStaff(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq);
	document.querySelector('#konten').innerHTML = tableDetailDiprosesStaffHTML();
	dataTableRequestDetailStaff();
}
function renderDetailStaff(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq);
	document.querySelector('#konten').innerHTML = tableDetailStaffHTML();
	dataTableRequestStaffDetail();
}
function renderSelesaiManager(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq, 1);
	document.querySelector('#konten').innerHTML = tableDetailKeluarHTML();
	document.querySelector('#btnConfirm').style.display = 'none';
	document.querySelector('#btnDelivery').style.display = 'none';
	fetch(`${baseUrl}gettransaction?noTransaction=${data.noTransaction}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noTransaksi').value = res.data.noTransaction;
			const tanggal = document.querySelector('#tanggal');
			tanggal.value = res.data.tglTransaction
			tanggal.disabled = true;
		})
		.catch(e => console.log(e));
	dataTableRequestDetailKeluarManager();
}
function renderDiprosesManager(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq);
	document.querySelector('#konten').innerHTML = tableDetailDiprosesManagerHTML();
	document.querySelector('#btnConfirm').style.display = 'none';
	dataTableRequestDetailDiprosesManager();
}
function renderSelesai(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq, 1);
	document.querySelector('#konten').innerHTML = tableDetailKeluarHTML();
	document.querySelector('#btnConfirm').style.display = 'none';
	document.querySelector('#btnDelivery').style.display = 'none';
	fetch(`${baseUrl}gettransaction?noTransaction=${data.noTransaction}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noTransaksi').value = res.data.noTransaction;
			const tanggal = document.querySelector('#tanggal');
			tanggal.value = res.data.tglTransaction
			tanggal.disabled = true;
		})
		.catch(e => console.log(e));
	dataTableRequestDetailKeluar();
}
function renderDiproses(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq, 1);
	document.querySelector('#konten').innerHTML = tableDetailDiprosesHTML();
	fetch(`${baseUrl}generatenotransaction`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#noTransaksi').value = res.data;
			document.querySelector('#tanggal').value = sekarang;
		})
		.catch(e => console.log(e));
	dataTableRequestDetailDiprosesGA();
}
function renderMenunggu(data) {
	document.querySelector('#header').innerHTML = headerHTML(data.noReq);
	document.querySelector('#konten').innerHTML = tableDetailHTML();
	dataTableRequestDetail();
}
function renderBtnKonfirmasi(data) {
	const btn = document.querySelector('#btnKonfirmasi');
	const param = [];
	data.forEach(data => {
		const input = document.querySelector(`#input${data.id}`);
		if(!input.value) {
			btn.disabled = true;
		} else {
			param.push(1);
		}
	});
	(data.length == param.length)? btn.removeAttribute('disabled') : btn.setAttribute('disabled', '');
}
function renderCariItemModal(id) {
	const body = tableCariItemHTML(id);
	const html = modalHTML('modalCariItem', 'Cari Item Master', body, '', 'modal-lg');
	document.querySelector('#modal').innerHTML = html;
	dataTableCariItem();
	$('#modalCariItem').modal();
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function success(text) {
	Swal.fire({
		title: 'Info',
		html: text,
		type: "success",
		confirmButtonText: 'Ok',
		confirmButtonColor: "#46b654",
	}).then((result) => {
		renderRequest();
	})
}
function sukses(text, aksi) {
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
function renderModalValidasi(id) {
	fetch(`${baseUrl}getrequestdetail?idDetail=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formValidasiHTML(res.data);
			const html = modalHTML('modalValidasi', 'Validasi Request', body, 'btConfirmValidasi');
			document.querySelector('#modal').innerHTML = html;
			dataTableCariItem();
			$('#modalValidasi').modal();
		});
}
function renderAksiValidasi() {
	dataTableRequestDetail();
	$('#modalValidasi').modal('hide');
}
function renderAksiUbah() {
	dataTableRequestDetailDiprosesGA();
	$('#modalUbah').modal('hide');
}
function renderAksiEditJumlah() {
	dataTableRequestDetailDiprosesGA();
	$('#modalEditJumlah').modal('hide');
}
function renderAksiTambah() {
	dataTableRequestDetailDiprosesGA();
	$('#modalTambah').modal('hide');
}
function renderCekAll(target) {
	const inputCheck = document.querySelectorAll('#tableReqDetail td input');
	inputCheck.forEach(checkbox => {
		checkbox.checked = (target.checked)? true : false;
	});
}
function ubah(id) {
	fetch(`${baseUrl}getallitemmaster`)
		.then(res => res.json())
		.then(res => {
			const body = ubahHTML(id);
			const html = modalHTML('modalUbah', 'Ubah Item Berdasarkan Data Master', body, 'btnKonfirmasiUbah');
			document.querySelector('#modal').innerHTML = html;
			let option = '<option value="">Pilih salah satu</option>'
			res.data.forEach(item => {
				option += `<option value="${item.id}">${item.itemmaster}</option>`;
			});
			document.querySelector('#namaItemUbah').innerHTML = option;
			$('#namaItemUbah').select2({dropdownParent: $('#modalUbah')});
			$('#modalUbah').modal();
			$('#namaItemUbah').on('select2:select', e => {
				fetch(`${baseUrl}getsingleitem?id=${e.target.value}`)
					.then(res => res.json())
					.then(res => {
						const stockUbah = document.querySelector('#stockUbah');
						stockUbah.value = '';
						stockUbah.value = res.data.stock;
					});
			});
		})
		.catch(e => console.log(e));
}
function tambah(id) {
	fetch(`${baseUrl}getrequestdetail?idDetail=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddHTML(id, res.data);
			const html =  modalHTML('modalTambah', 'Tambahkan Item ke Data Master', body, 'btnKonfirmasiTambah');
			document.querySelector('#modal').innerHTML = html;
			renderKategori();
			renderUnit('unitTerbesar');
			renderUnit('unitTerkecil');
			$('#modalTambah').modal();
		})
		.catch(e => console.log(e));
}
function renderKategori() {
	fetch(`${baseUrl}getallkategori`)
		.then(res => res.json())
		.then(res => {
			html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(kategori => {
				html += `<option value="${kategori.id}">${kategori.kategori}</option>`;
			});
			document.querySelector('#kategori').innerHTML = html;
		});
}
function renderUnit(target) {
	fetch(`${baseUrl}getallunit`)
		.then(res => res.json())
		.then(res => {
			html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(unit => {
				html += `<option value="${unit.id}">${unit.unit}</option>`;
			});
			document.querySelector(`#${target}`).innerHTML = html;
		});
}
function editJumlah(id) {
	fetch(`${baseUrl}getrequestdetail?idDetail=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formEditJumlahHTML(res.data);
			const html =  modalHTML('modalEditJumlah', 'Edit Jumlah', body, 'btnKonfirmasiEditJumlah');
			document.querySelector('#modal').innerHTML = html;
			$('#modalEditJumlah').modal();
		})
		.catch(e => console.log(e));	
}
function renderAwal() {
	document.querySelector('#header').innerHTML = headerHTML();
	document.querySelector('#konten').innerHTML = tableUtamaHTML();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	dataTableUtama();
}
function renderAddModal() {
	const body = formAddHTML(1);
	const html = modalHTML('modalAddItem', 'Tambah Item', 'btnSaveItem', body, 'modal-lg');
	document.querySelector('#modal').innerHTML = html;
	renderSelectFixed();
	renderSelectSifat();
	renderSelectKategori();
	renderSelectUnit('unitTerbesar');
	renderSelectUnit('unitTerkecil');
	$('#modalAddItem').modal();
}
function renderEditModal(id) {
	fetch(`${baseUrl}getitemmaster?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddHTML(2, res.data);
			const html = modalHTML('modalAddItem', 'Edit Item', 'btnSaveItem', body, 'modal-lg');
			document.querySelector('#modal').innerHTML = html;
			document.querySelector('#btnSaveItem').disabled = false;
			renderSelectFixed(res.data.fixed);
			renderSelectSifat(res.data.bhp);
			renderSelectKategori(res.data.idkategori);
			renderSelectUnit('unitTerbesar', res.data.unitTerbesar);
			renderSelectUnit('unitTerkecil', res.data.unit);
			$('#modalAddItem').modal();
		})
		.catch(e => console.log(e));
}
function renderHapusModal(id) {
	fetch(`${baseUrl}getitemmaster?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formDeleteHTML(res.data);
			const html = modalHTML('modalHapusItem', 'Hapus Item', 'btnHapusItem', body);
			document.querySelector('#modal').innerHTML = html;
			document.querySelector('#btnHapusItem').disabled = false;
			$('#modalHapusItem').modal();
		})
		.catch(e => console.log(e));
}
function renderCariAccountNoModal() {
	body = tableAccountHTML();
	const html = modalHTML('modalCariAccount', 'Cari Account', 'btnCari', body, 'modal-lg');
	document.querySelector('#modal2').innerHTML = html;
	document.querySelector('#btnCari').style.display = 'none';
	dataTableCariAccount();
	$('#modalCariAccount').modal();
}
function renderSelectFixed(dataFixed = '') {
	fetch(`${baseUrl}getfixed`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(fixed => {
				html += `<option value="${fixed[0]}" ${(fixed[0] == dataFixed)? 'selected' : ''}>${fixed[1]}</option>`;
			});
			document.querySelector('#fixed').innerHTML = html;
		})
		.catch(e => console.log(e));
}
function renderSelectSifat(dataBHP = '') {
	fetch(`${baseUrl}getsifat`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(bhp => {
				html += `<option value="${bhp[0]}" ${(bhp[0] == dataBHP)? 'selected' : ''}>${bhp[1]}</option>`;
			});
			const sifat = document.querySelector('#bhp');
			sifat.innerHTML = html;
			sifat.disabled = (dataBHP == 0)? true : false;
		})
		.catch(e => console.log(e));
}
function renderSelectKategori(id = '') {
	fetch(`${baseUrl}getallkategori`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data.id}" ${(data.id == id)? 'selected' : ''}>${data.kategori}</option>`
			});
			document.querySelector('#kategori').innerHTML = html;
		})
		.catch(e => console.log(e));
}
function renderSelectUnit(target, id = '') {
	fetch(`${baseUrl}getallunit`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Pilih salah satu</option>';
			res.data.forEach(data => {
				html += `<option value="${data.id}" ${(data.id == id)? 'selected' : ''}>${data.unit}</option>`
			});
			document.querySelector(`#${target}`).innerHTML = html;
		})
		.catch(e => console.log(e));
}
function renderBtnSaveItem() {
	const btnSaveItem = document.querySelector('#btnSaveItem');
	const kategori = document.querySelector('#kategori').value;
	const namaItem = document.querySelector('#namaItem').value;
	const unitTerbesar = document.querySelector('#unitTerbesar').value;
	const unitTerkecil = document.querySelector('#unitTerkecil').value;
	const jmlTerkecil = document.querySelector('#jmlTerkecil').value;
	const fixed = document.querySelector('#fixed').value;
	const bhp = document.querySelector('#bhp').value;
	const accountNo = document.querySelector('#accountNo').value;
	if(fixed) {
		if(fixed == 1) {
			if(kategori && namaItem && unitTerbesar && unitTerkecil && jmlTerkecil && fixed && accountNo) {
				btnSaveItem.disabled = false;
			} else {
				btnSaveItem.disabled = true;
			}
		} else {
			if(kategori && namaItem && unitTerbesar && unitTerkecil && jmlTerkecil && fixed && bhp && accountNo) {
				btnSaveItem.disabled = false;
			} else {
				btnSaveItem.disabled = true;
			}
		}
	}
}
function renderSifat(fixed) {
	const bhp = document.querySelector('#bhp');
	if(fixed == 2) {
		bhp.disabled = false
	} else {
		bhp.disabled = true;
		bhp.selectedIndex = 0;
	}
	renderBtnSaveItem();
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function success(text, aksi) {
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
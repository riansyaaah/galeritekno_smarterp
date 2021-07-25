function renderUtama() {
	document.querySelector('#header').innerHTML = headerUtamaHTML();
	document.querySelector('#konten').innerHTML = tableUtamaHTML();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	document.querySelector('#card2').innerHTML = '';
	renderInstansiFilter();
	renderPICMarketingFilter();
	renderPaketPemeriksaanFilter();
	renderCabangFilter();
	renderStatusHasilFilter();
	dataTableUtama();
}
function log(id) {
	document.querySelector('#header').innerHTML = headerDetailHTML();
	document.querySelector('#konten').innerHTML = tableLogElement();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	document.querySelector('#card2').innerHTML = '';
	dataTableLog(id);
}
function renderCetakBarcode(id) {
	window.open(`${baseUrl}cetakbarcode?id=${id}`);
}
function renderCetakKwitansi() {
	const idDetail = document.querySelector('#idDetail').value;
	window.open(`${baseUrl}cetakkwitansi?idDetail=${idDetail}`);
}
function renderAddPesertaDetailModal() {
	const idpayment = document.querySelector('#idpayment').value;
	const body = formAddPesertaHTML(1, idpayment);
	const html = modalHTML('modalAddPesertaDetail', 'Tambah Peserta', 'btnAddPeserta', body, 'modal-xl');
	document.querySelector('#modal').innerHTML = html;
	renderPICMarketing();
	renderCabang();
	renderJenisLayanan();
	renderCaraPembayaran();
	$('#modalAddPesertaDetail').modal();
}
function renderEditModal(id) {
	fetch(`${baseUrl}getregperiksasingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formAddPesertaHTML(2, res.data.idpayment, res.data);
			const html = modalHTML('editPesertaModal', 'Edit Peserta', 'btnEditPeserta', body, 'modal-xl');
			document.querySelector('#modal').innerHTML = html;
			document.querySelector('#btnEditPeserta').disabled = false;
		    renderPICMarketing(res.data);
			renderCabang(res.data);
			renderJenisLayanan(res.data);
			renderCaraPembayaran(res.data);
			renderPaketPemeriksaan(res.data.idcabang, res.data);
			renderJamKunjungan(res.data.idjenispemeriksaandetail, res.data);
			renderFaskes(res.data.idcabang, res.data);
			renderInstansi(res.data.idcabang, res.data);
			$('#editPesertaModal').modal();
		})
		.catch(e => console.log(e));
}
function renderRescheduleModal(id) {
	fetch(`${baseUrl}getregperiksasingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formRescheduleModalHTML(res.data);
			const html = modalHTML('rescheduleModal', 'Reschedule', 'btnReschedule', body);
			document.querySelector('#modal').innerHTML = html;
			renderJam(res.data);
			document.querySelector('#btnReschedule').disabled = false;
			$('#rescheduleModal').modal();
		})
		.catch(e => console.log(e));
}
function renderHadirModal(id) {
	fetch(`${baseUrl}getregperiksasingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formHadirSingleHTML(res.data);
			const html = modalHTML('hadirModal', 'Hadir', 'btnHadir', body);
			document.querySelector('#modal').innerHTML = html;
			document.querySelector('#btnHadir').disabled = false;
			$('#hadirModal').modal();
		})
		.catch(e => console.log(e));
}
function renderJam(data) {
	fetch(`${baseUrl}getalljam?idPemeriksaanDetail=${data.idjenispemeriksaandetail}`)
		.then(res => res.json())
		.then(res => {
			let html = '';
			res.data.forEach(jam => {
				html += `<option value="${jam.jam}" ${(data.jamkunjungan == jam.jam)? 'selected' : ''}>${jam.jam}</option>`;
			});
			document.querySelector('#jmKunjungan').innerHTML = html;
		})
		.catch(e => console.log(e));
}
function renderDetail(id) {
	fetch(`${baseUrl}getregperiksasingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#header').innerHTML = headerDetailHTML(res.data.id);
			document.querySelector('#konten').innerHTML = kontenDetailHTML(res.data);
			document.querySelector('#modal').innerHTML = '';
			document.querySelector('#modal2').innerHTML = '';
			document.querySelector('#card2').innerHTML = tableDetailHTML();
			dataTableDetail(res.data.idpayment);
		})
		.catch(e => console.log(e));
}
function renderAksiBerhasilReschedule() {
	const idpayment = document.querySelector('#idpayment').value;
	dataTableDetail(idpayment);
	$('#rescheduleModal').modal('hide');
}
function renderAksiBerhasilHadirSemua() {
	const idpayment = document.querySelector('#idpayment').value;
	dataTableDetail(idpayment);
	$('#modalHadirSemua').modal('hide');
}
function renderAksiBerhasilEdit() {
	const idpayment = document.querySelector('#idpayment').value;
	dataTableDetail(idpayment);
	$('#editPesertaModal').modal('hide');
}
function renderAksiBerhasilHadirSingle() {
	const idpayment = document.querySelector('#idpayment').value;
	dataTableDetail(idpayment);
	$('#hadirModal').modal('hide');
}
function renderAksiBerhasilInput() {
	dataTableUtama();
	$('.modal').modal('hide');
}
function renderAddPesertaModal() {
    const body = formAddPesertaHTML(1);
    const html = modalHTML('modalAddPeserta', 'Tambah Peserta', 'btnAddPeserta', body, 'modal-xl');
    document.querySelector('#modal').innerHTML = html;
    renderPICMarketing();
	renderCabang();
	renderJenisLayanan();
	renderCaraPembayaran();
    $('#modalAddPeserta').modal();
}
function renderHadirSemuaModal() {
	const idpayment = document.querySelector('#idpayment').value;
	const body = formHadirSemuaHTML(idpayment);
	const html = modalHTML('modalHadirSemua', 'Hadir Semua', 'btnConfirmHadirSemua', body);
	document.querySelector('#modal').innerHTML = html;
	document.querySelector('#btnConfirmHadirSemua').disabled = false;
	$('#modalHadirSemua').modal();
}
function renderHapusModal(id) {
	fetch(`${baseUrl}getregperiksasingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formHapusPersertaHTML(res.data);
		    const html = modalHTML('modalHapusPeserta', 'Hapus Peserta', 'btnHapusPeserta', body);
		    document.querySelector('#modal').innerHTML = html;
		    document.querySelector('#btnHapusPeserta').disabled = false;
		    $('#modalHapusPeserta').modal();
		})
		.catch(e => console.log(e));
}
function renderDeleteModal(id) {
	fetch(`${baseUrl}getregperiksasingle?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const body = formHapusPersertaHTML(res.data);
		    const html = modalHTML('modalDeletePeserta', 'Hapus Peserta', 'btnDeletePeserta', body);
		    document.querySelector('#modal').innerHTML = html;
		    document.querySelector('#btnDeletePeserta').disabled = false;
		    $('#modalDeletePeserta').modal();
		})
		.catch(e => console.log(e));
}
function renderAksiBerhasilDeletePeserta() {
	const idpayment = document.querySelector('#idpayment').value;
	fetch(`${baseUrl}getregperiksaidpayment?idpayment=${idpayment}`)
		.then(res => res.json())
		.then(res => {
			$('#modalDeletePeserta').modal('hide');
			(res.data.length < 1)? renderUtama() : dataTableDetail(idpayment);
		})
		.catch(e => console.log(e));
}
function renderPICMarketing(data = '') {
    fetch(`${baseUrl}getallstaffmarketing`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(staff => {
                html += `<option value="${staff.id}" ${(staff.id == data.pic_m)? 'selected' : ''}>${staff.first_name} ${staff.last_name}</option>`;
            });
            document.querySelector('#picMarketing').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderCabang(data = '') {
    fetch(`${baseUrl}getallcabang`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(cabang => {
                html += `<option value="${cabang.id}" ${(cabang.id == data.idcabang)? 'selected' : ''}>${cabang.nama}</option>`;
            });
            document.querySelector('#cabang').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderJenisLayanan(data = '') {
    fetch(`${baseUrl}getjenislayanan`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(layanan => {
                html += `<option value="${layanan}" ${(layanan == data.tipekunjungan)? 'selected' : ''}>${layanan}</option>`;
            });
            document.querySelector('#jenisLayanan').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderFaskes(idCabang, data = '') {
    fetch(`${baseUrl}getallfaskes?idCabang=${idCabang}`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(faskes => {
                html += `<option value="${faskes.id}" ${(faskes.id == data.idfaskes)? 'selected' : ''}>${faskes.namafaskes}</option>`;
            });
            const faskesAsal = document.querySelector('#faskesAsal');
            faskesAsal.innerHTML = html;
            faskesAsal.disabled = false;
        })
        .catch(e => console.log(e));
}
function renderInstansi(idCabang, data = '') {
    fetch(`${baseUrl}getallInstansi?idCabang=${idCabang}`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(instansi => {
                html += `<option value="${instansi.id}" ${(instansi.id == data.idinstansi)? 'selected' : ''}>${instansi.instansi}</option>`;
            });
            const instansi = document.querySelector('#instansi');
            instansi.innerHTML = html;
            instansi.disabled = false;
        })
        .catch(e => console.log(e));
}
function renderCaraPembayaran(data = '') {
    fetch(`${baseUrl}getcarapembayaran`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(cara => {
                html += `<option value="${cara}" ${(cara == data.carabayar)? 'selected' : ''}>${cara}</option>`;
            });
            document.querySelector('#caraPembayaran').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderJamKunjungan(idPemeriksaanDetail, data = '') {
    fetch(`${baseUrl}getalljam?idPemeriksaanDetail=${idPemeriksaanDetail}`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value=""></option>';
            res.data.forEach(jam => {
                html += `<option value="${jam.jam}" ${(jam.jam == data.jamkunjungan)? 'selected' : ''}>${jam.jam}</option>`;
            });
            const jamKunjungan = document.querySelector('#jamKunjungan');
            jamKunjungan.innerHTML = html;
            jamKunjungan.disabled = false;
        })
        .catch(e => console.log(e));
}
function renderPaketPemeriksaan(cabang, data = '') {
    fetch(`${baseUrl}getallpaketpemeriksaan?idCabang=${cabang}`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(paket => {
                html += `<option value="${paket.id}" ${(paket.id == data.idjenispemeriksaandetail)? 'selected' : ''}>${paket.detailketerangan}</option>`;
            });
            const paketPemeriksaan = document.querySelector('#paketPemeriksaan');
            paketPemeriksaan.innerHTML = html;
            paketPemeriksaan.disabled = false;
        })
        .catch(e => console.log(e));
}
function renderBtnRegistrasi() {
    const namaLengkap = document.querySelector('#namaLengkap').value;
    const customRadio = document.querySelector('input[name="customRadio"]').value;
    const tempatLahir = document.querySelector('#tempatLahir').value;
    const tanggalLahir = document.querySelector('#tanggalLahir').value;
    const nomorHP = document.querySelector('#nomorHP').value;
    const alamat = document.querySelector('#alamat').value;
    const picMarketing = document.querySelector('#picMarketing').value;
    const cabang = document.querySelector('#cabang').value;
    const jenisLayanan = document.querySelector('#jenisLayanan').value;
    const paketPemeriksaan = document.querySelector('#paketPemeriksaan').value;
    const tanggalKunjungan = document.querySelector('#tanggalKunjungan').value;
    const jamKunjungan = document.querySelector('#jamKunjungan').value;
    const faskesAsal = document.querySelector('#faskesAsal').value;
    const instansi = document.querySelector('#instansi').value;
    const caraPembayaran = document.querySelector('#caraPembayaran').value;
    const btn = document.querySelector('#btnAddPeserta');
    btn.disabled = (namaLengkap && customRadio && tempatLahir && nomorHP && alamat && picMarketing && cabang && jenisLayanan && paketPemeriksaan && tanggalKunjungan && jamKunjungan && faskesAsal && instansi && caraPembayaran)? false : true;
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
function renderInstansiFilter() {
    fetch(`${baseUrl}getinstansi`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(instansi => {
                html += `<option value="${instansi.id}">${instansi.instansi}</option>`;
            });
            document.querySelector('#filterInstansi').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderPICMarketingFilter() {
    fetch(`${baseUrl}getallstaffmarketing`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(staff => {
                html += `<option value="${staff.id}">${staff.first_name} ${staff.last_name}</option>`;
            });
            document.querySelector('#filterPICMarketing').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderPaketPemeriksaanFilter() {
    fetch(`${baseUrl}getpaketpemeriksaan`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(paket => {
                html += `<option value="${paket.id}">${paket.namaPaket}</option>`;
            });
            document.querySelector('#filterPaketPemeriksaan').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderCabangFilter() {
    fetch(`${baseUrl}getcabang`)
        .then(res => res.json())
        .then(res => {
            let html = '<option value="">Pilih salah satu</option>';
            res.data.forEach(cabang => {
                html += `<option value="${cabang.id}">${cabang.namaCabang}</option>`;
            });
            document.querySelector('#filterCabang').innerHTML = html;
        })
        .catch(e => console.log(e));
}
function renderStatusHasilFilter() {
    fetch(`${baseUrl}getstatushasil`)
        .then(res => res.json())
        .then(res => {
            let html = '';
            res.data.forEach(status => {
                html += `<option value="${status.id}">${status.status}</option>`;
            });
            document.querySelector('#filterStatusHasil').innerHTML = html;
        })
        .catch(e => console.log(e));
}
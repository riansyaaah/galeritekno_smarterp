function getParam(data) {
	return new URLSearchParams(data).toString();
}
function saveRecommend(btn) {
	let form = {
		noRecommend: document.querySelector('#noRecommend').value,
		tglRecommend: document.querySelector('#tglRecommend').value
	}
	form = getParam(form);
	const namaBtn = '<i class="fa fa-save"></i> Simpan Berita Acara';
	inputData(btn, 'saverecommend', form, namaBtn, aksiSaveRecommend);
}
function inputData(btn, url, data, namaBtn, aksi) {
	btn.innerHTML = 'Loading...';
	btn.setAttribute('disabled', '');
	fetch(`${baseUrl+url}?${data}`)
		.then(res => res.json())
		.then(res => {
			if(res.status_json) {
				btn.innerHTML = namaBtn;
				btn.setAttribute('disabled', '');
				success(res.remarks, aksi);
			} else {
				showSnackError(res.remarks);
				btn.innerHTML = 'Coba Lagi';
				btn.removeAttribute('disabled');
			}
		})
		.catch(e => {
			showSnackError(e);
			btn.innerHTML = 'Coba Lagi';
			btn.removeAttribute('disabled');
		});
}
function saveDetailValidasi(btn) {
	const namaToko = document.querySelector('#namaToko');
	const namaProduk = document.querySelector('#namaProduk');
	const lokasi = document.querySelector('#lokasi');
	const bonus = document.querySelector('#bonus');
	const warna = document.querySelector('#warna');
	const ukuran = document.querySelector('#ukuran');
	const kelengkapan = document.querySelector('#kelengkapan');
	const hargaSatuan = document.querySelector('#hargaSatuan');
	const ongkir = document.querySelector('#ongkir');
	const estimasi = document.querySelector('#estimasi');
	const gambar = document.querySelector('#gambar');
	let form = {
		idDetail: document.querySelector('#idDetail').value,
		status: document.querySelector('#status').value,
		noRecommend: document.querySelector('#noRecommend').value,
		namaToko: namaToko.value,
		namaProduk: namaProduk.value,
		lokasi: lokasi.value,
		bonus: bonus.value,
		warna: warna.value,
		ukuran: ukuran.value,
		kelengkapan: kelengkapan.value,
		hargaSatuan: hargaSatuan.value,
		ongkir: ongkir.value,
		estimasi: estimasi.value
	}
	if(!form.namaToko) {
		namaToko.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.namaProduk) {
		namaProduk.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.lokasi) {
		lokasi.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.bonus) {
		bonus.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.warna) {
		warna.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.ukuran) {
		ukuran.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.kelengkapan) {
		kelengkapan.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.hargaSatuan) {
		hargaSatuan.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.ongkir) {
		ongkir.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(!form.estimasi) {
		estimasi.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else if(gambar.files.length < 1) {
		gambar.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else {
		saveDetail(btn, form);
		// uploadGambar(form.noRecommend, gambar);
	}
}
function saveDetail(btn, form) {
	form = getParam(form);
	const namaBtn = 'Konfirmasi';
	inputData(btn, 'savedetail', form, namaBtn, aksiSaveDetail);
}
function uploadGambar(noRecommend, gambar) {
	const token = '<?php echo $this->security->get_csrf_token_name(); ?>';
	const hash = '<?php echo $this->security->get_csrf_hash(); ?>';
	const formData = new FormData();
    formData.append('gambar', gambar.files[0]);
    formData.append('noRecommend', noRecommend);
    formData.append(token, hash);
    $.ajax({
        url: `${baseUrl}upload`,
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: res => {
            console.log(res);
        },
        error: (XMLHttpRequest, textStatus, errorThrown) => {
            console.log(XMLHttpRequest, textStatus, errorThrown);
        },
        timeout: 60000 
    });
}
function hapusDetail(btn) {
	const id = document.querySelector('#idHapus').value;
	inputData(btn, 'hapus', `id=${id}`, 'btnHapus', renderAksiHapus);
}
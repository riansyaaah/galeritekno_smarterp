function inputAdd(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const table = $('#tableAdd').DataTable();
	let form = {
		period_id: document.querySelector('#period').value,
		start_date: document.querySelector('#start_date').value,
		end_date: document.querySelector('#end_date').value,
		shift_id: document.querySelector('#shift_id').value
	}
	form = `${new URLSearchParams(form).toString()}&${table.$('input').serialize()}`;
	console.log(`${baseUrl}saveaddshift?${form}`);
	fetch(`${baseUrl}saveaddshift?${form}`)
		.then(res => res.json())
		.then(res => renderAksiBerhasilInput(res, btn, 'modalAdd'))
		.catch(e => renderAksiGagalInput(e, btn));
}
function deleteShift(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const id = document.querySelector('#idDelete').value;
	fetch(`${baseUrl}deleteshift?id=${id}`)
		.then(res => res.json())
		.then(res => renderAksiBerhasilInput(res, btn, 'modalDelete'))
		.catch(e => renderAksiGagalInput(e, btn));
}
function inputSwap(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	let form = {
		id: document.querySelector('#idSwap').value,
		idPersonel: document.querySelector('#idPersonel').value
	}
	form = new URLSearchParams(form).toString();
	fetch(`${baseUrl}saveswap?${form}`)
		.then(res => res.json())
		.then(res => renderAksiBerhasilInput(res, btn, 'modalSwap'))
		.catch(e => renderAksiGagalInput(e, btn));
}
function inputEdit(btn) {
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	const shift = document.querySelector('#shift');
	let form = {
		id: document.querySelector('#idEdit').value,
		shift: shift.value
	}
	if(!form.shift) {
		shift.classList.add('is-invalid');
		showSnackError('Harus diisi');
	} else {
		form = new URLSearchParams(form).toString();
		fetch(`${baseUrl}saveedit?${form}`)
			.then(res => res.json())
			.then(res => renderAksiBerhasilInput(res, btn, 'modalEdit'))
			.catch(e => renderAksiGagalInput(e, btn));
	}
}
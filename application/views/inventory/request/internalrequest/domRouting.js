document.querySelector('#form').addEventListener('click', e => {
	if(e.target.id == 'btnSave') {
		saveReq(e.target);
	} else if(e.target.id == 'btnAddItem') {
		renderAddModal();
	} else if(e.target.id == 'btnSelesai') {
		renderUtama();
	} else if(e.target.id == 'btnCariReq') {
		renderCariReqModal();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnCariItem') {
		renderCariItemModal();
	} else if(e.target.id == 'btnConfirmItem') {
		inputDetail(e.target, 'modalAddItem');
	} else if(e.target.id == 'btnDeleteItem') {
		deleteDetail(e.target);
	}
});
document.querySelector('#modal').addEventListener('keyup', e => {
	if(e.target.className == 'select2-search__field') {
		document.querySelector('#namaItem').innerHTML = '';
		const url = (e.target.value == '' || !e.target.value)? `getallitem` : `searchitem?kata=${e.target.value}`;
		fetch(baseUrl+url)
			.then(res => res.json())
			.then(res => {
				let html = '';
				res.data.forEach(data => {
					html += `<option value="${data.id}">${data.itemmaster}</option>`;
				});
				if(res.data.length < 2) {
					document.querySelector('#stock').value = 0;
				}
				document.querySelector('#namaItem').innerHTML = html;
			})
			.catch(e => console.log(e));
	}
});
$('#modal').on('select2:select', e => {
	if(e.target.className == 'select2') {
		fetch(`${baseUrl}getitem?id=${e.target.value}`)
			.then(res => res.json())
			.then(res => {
				document.querySelector('#stock').value = res.data.stock;
			});
	}
});
document.querySelector('#konten').addEventListener('dblclick', e => {
	if(e.target.tagName == 'TD') {
		// renderInput(e.target);
	}
});
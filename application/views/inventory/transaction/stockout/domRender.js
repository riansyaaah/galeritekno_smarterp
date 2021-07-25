function renderUtama() {
	document.querySelector('#header').innerHTML = '';
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	document.querySelector('#konten').innerHTML = tableOutgoing();
	dataTableOutgoing();
}
function renderDetail(id) {
	document.querySelector('#header').innerHTML = headerHTML();
	document.querySelector('#modal').innerHTML = '';
	document.querySelector('#modal2').innerHTML = '';
	document.querySelector('#konten').innerHTML = tableDetailHTML();
	dataTableDetail(id);
}
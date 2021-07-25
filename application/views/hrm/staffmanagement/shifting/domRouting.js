document.querySelector('#form').addEventListener('change', e => {
	if(e.target.id == 'start_date') {
		renderStartChange();
	} else if(e.target.id == 'end_date') {
		renderEndChange();
	} else if(e.target.id == 'shift_id') {
		renderShiftChange();
	}
});
document.querySelector('#form').addEventListener('click', e => {
	if(e.target.id == 'btnCariPeriode') {
		renderModalCariPeriode();
	}
});
document.querySelector('#konten').addEventListener('click', e => {
	if(e.target.id == 'btnAdd') {
		renderModalAdd();
	}
});
document.querySelector('#modal').addEventListener('click', e => {
	if(e.target.id == 'btnSaveAdd') {
		inputAdd(e.target);
	} else if(e.target.id == 'btnDelete') {
		deleteShift(e.target);
	} else if(e.target.id == 'btnCariStaff') {
		renderModalCariStaff();
	} else if(e.target.id == 'btnSwap') {
		inputSwap(e.target);
	} else if(e.target.id == 'btnEdit') {
		inputEdit(e.target);
	}
});
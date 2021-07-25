function renderHalamanUtama(a = null, b = null) {
	const title = document.querySelector('#title').value;
	document.querySelector('#header').innerHTML = headerUtamaHTML(title);
	document.querySelector('#konten').innerHTML = tableUtamaHTML();
	dataTableUtama();
}
function download(idStaff, tahun, bulan) {
    document.querySelector('#print').innerHTML = `<a target="_blank" id="cetak" href="${baseUrl}cetakpayslip?idStaff=${idStaff}&tahun=${tahun}&bulan=${bulan}"></a>`;
    document.querySelector('#cetak').click();
}
function detailPersonal(id) {
	document.querySelector('#header').dataset.id = id;
    document.querySelector('#nav').innerHTML = navPersonalHTML();
    document.querySelector('#header').innerHTML = backHTML();
    document.querySelector('#konten').innerHTML = '';
    awalPersonal(id);
}
function awalPersonal(id) {
	fetch(`${baseUrl}getstaffprofilebyid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			document.querySelector('#konten').innerHTML = infoPersonalHTML(res.data);
			document.querySelector('#judulBack').innerHTML = res.data.first_name;
		})
		.catch(e => console.log(e));
}
function backAction() {
	document.querySelector('#header').innerHTML = '';
	document.querySelector('#nav').innerHTML = '';
	document.querySelector('#konten').innerHTML = '';
	renderHalamanUtama();
}
function detailEmployee(id) {
    document.querySelector('#header').dataset.id = id;
    document.querySelector('#nav').innerHTML = navHTML();
    document.querySelector('#header').innerHTML = backHTML();
    document.querySelector('#konten').innerHTML = '';
    awalEmployee(id);
}
function awalEmployee(id) {
    resetActive();
    document.querySelector('#navInfo').classList.add('active');
    fetch(`${baseUrl}getemployee?id=${id}`)
        .then(res => res.json())
        .then(res => {
            document.querySelector('#konten').innerHTML = infoEmployeeHTML(res.data);
            document.querySelector('#judulBack').innerHTML = res.data.first_name;
        });
}
function changePage(target, html) {
    resetActive();
    target.classList.add('active');
    document.querySelector('#konten').innerHTML = html;
}
function resetActive() {
    const navLink = document.querySelectorAll('.nav-link');
    navLink.forEach(nav => {
        if(nav.classList.contains('active')) {
            nav.classList.remove('active');
        }
    });
}
function renderTipeFileDocument(data = null) {
	fetch(`${baseUrl}gettipefile`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(tipe => {
				html += `<option value="${tipe}" ${(!data)? '' : ((tipe == data.document_type)? 'selected' : '')}>${tipe}</option>`
			});
			document.querySelector('#typeDocument').innerHTML = html;
		});
}
function renderPendidikan(data = null) {
	fetch(`${baseUrl}getpendidikan`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(pendidikan => {
				html += `<option value="${pendidikan}" ${(!data)? '' : ((pendidikan == data.education_level)? 'selected' : '')}>${pendidikan}</option>`;
			});
			document.querySelector('#educationLevelFamilyMember').innerHTML = html;
		});
}
function renderKontrak(id = null) {
	fetch(`${baseUrl}getkontrak`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(kontrak => {
				html += `<option value="${kontrak.id}" ${(kontrak.id == id)? 'selected' : ''}>${kontrak.description} (${kontrak.days} days)</option>`;
			});
			document.querySelector('#contract_id').innerHTML = html;
		});
}
function renderDaerah(url, param, idTarget, id = null) {
	fetch(`https://dev.farizdotid.com/api/daerahindonesia/${url}`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>'
			res[param].forEach(data => {
				html += `<option value="${data.id}" ${(data.id == id)? 'selected' : ''}>${data.nama}</option>`
			});
			document.querySelector(`#${idTarget}`).innerHTML = html;
		});
}
function renderShift(id = null) {
	fetch(`${baseUrl}getShift`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(shift => {
				const day = shift.day.toLowerCase().replace(/\b[a-z]/g, letter => letter.toUpperCase());
				html += `<option value="${shift.id}" ${(shift.id == id)? 'selected' : ''}>${shift.shift} ~ ${day} (${shift.start_time} - ${shift.end_time})</option>`;
			});
			document.querySelector('#shift_id').innerHTML = html;
		});
}
function renderPosition(id = null) {
	fetch(`${baseUrl}getposition`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(position => {
				html += `<option value="${position.id}" ${(position.id == id)? 'selected' : ''}>${position.position}</option>`;
			});
			document.querySelector('#position_id').innerHTML = html;
		});
}
function renderDepartment(id = null) {
	fetch(`${baseUrl}getdepartement`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(department => {
				html += `<option value="${department.id}" ${(department.id == id)? 'selected' : ''}>${department.department}</option>`;
			})
			document.querySelector('#departement_id').innerHTML = html;
		});
}
function renderInstansi(id = null) {
	fetch(`${baseUrl}getinstansi`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(instansi => {
				html += `<option value="${instansi.instansi_id}" ${(instansi.instansi_id == id)? 'selected' : ''}>${instansi.nama_instansi}</option>`;
			})
			document.querySelector('#instansi_id').innerHTML = html;
		});
}
function renderBranch(id = null) {
	fetch(`${baseUrl}getbranch`)
		.then(res => res.json())
		.then(res => {
			let html = '<option value="">Please Select</option>';
			res.data.forEach(branch => {
				html += `<option value="${branch.branch_id}" ${(branch.branch_id == id)? 'selected' : ''}>${branch.nama_branch}</option>`
			});
			document.querySelector('#branch_id').innerHTML = html;
		});
}
function renderInfoEmployee(id) {
	awalEmployee(id);
}
function renderPayroll(target, id) {
	changePage(target, payrollHTML());
    dataPayroll(id);
}
function renderPayslip(target, id) {
	changePage(target, payslipHTML());
    dataPayslip(id);
}
function renderBasicProfile(target, id) {
	awalPersonal(id);
	resetActive();
	target.classList.add('active');
}
function renderEmergencyContacts(target, id) {
	changePage(target, emergencyContactsHTML());
	dataEmergencyContacts(id);
}
function renderDocuments(target, id) {
	changePage(target, documentsHTML());
	dataDocuments(id);
}
function renderQualifications(target, id) {
	changePage(target, qualificationsHTML());
	dataQualifications(id);
}
function renderWorkExperience(target, id) {
	changePage(target, workExperienceHTML());
	dataWorkExperience(id);
}
function renderBankAccount(target, id) {
	changePage(target, bankAccountHTML());
	dataBankAccount(id);
}
function renderFamilyMembers(target, id) {
	changePage(target, familyMembersHTML());
	dataFamilyMembers(id);
}
function editEmergencyContact(id) {
	fetch(`${baseUrl}getcontactid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				idStaff = document.querySelector('#header').dataset.id;
				document.querySelector('#modal').innerHTML = modalHTML('EditEmergencyContact', 'Edit Emergency Contact', 'Contact', formInputContact('edit', idStaff, res.data));
				$("#modalEditEmergencyContact").modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function editDocument(id) {
	fetch(`${baseUrl}getdocumentid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				idStaff = document.querySelector('#header').dataset.id;
				document.querySelector('#modal').innerHTML = modalHTML('EditDocument', 'Edit Document', 'Document', formInputDocument('edit', idStaff, res.data));
				renderTipeFileDocument(res.data);
				$("#modalEditDocument").modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function editQualification(id) {
	fetch(`${baseUrl}getqualificationid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				idStaff = document.querySelector('#header').dataset.id;
				document.querySelector('#modal').innerHTML = modalHTML('EditQualification', 'Edit Qualification', 'Qualifications', formInputQualifications('edit', idStaff, res.data));
				$("#modalEditQualification").modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function editExperience(id) {
	fetch(`${baseUrl}getexperienceid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				idStaff = document.querySelector('#header').dataset.id;
				document.querySelector('#modal').innerHTML = modalHTML('EditWorkExperience', 'Edit Work Experience', 'WorkExperience', formInputWorkExperience('edit', idStaff, res.data));
				$("#modalEditWorkExperience").modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function editBankAccount(id) {
	fetch(`${baseUrl}getbankaccountid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				idStaff = document.querySelector('#header').dataset.id;
				document.querySelector('#modal').innerHTML = modalHTML('EditBankAccount', 'Edit Bank Account', 'BankAccount', formInputBankAccount('edit', idStaff, res.data));
				$("#modalEditBankAccount").modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function editFamilyMember(id) {
	fetch(`${baseUrl}getFamilyMemberId?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				idStaff = document.querySelector('#header').dataset.id;
				document.querySelector('#modal').innerHTML = modalHTML('EditFamilyMember', 'Edit Family Member', 'FamilyMembers', formInputFamilyMembers('edit', idStaff, res.data));
				renderPendidikan(res.data);
				$("#modalEditFamilyMember").modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function deleteQualification(id) {
	renderDeleteModal('getQualificationId', id, 'Qualifications', 'school');
}
function deleteDocument(id) {
	renderDeleteModal('getdocumentid', id, 'Documents', 'document_name');
}
function deleteEmergencyContact(id) {
	renderDeleteModal('getcontactid', id, 'EmergencyContacts', 'name');
}
function deleteExperience(id) {
	renderDeleteModal('getexperienceid', id, 'WorkExperience', 'company');
}
function deleteBankAccount(id) {
	renderDeleteModal('getbankAccountid', id, 'BankAccount', 'bank_name');
}
function deleteFamilyMember(id) {
	renderDeleteModal('getfamilymemberid', id, 'FamilyMembers', 'name');
}
function renderDeleteModal(url, id, menu, param) {
	fetch(`${baseUrl+url}?id=${id}`)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				const form = formDelete(res.data.id, res.data[param]);
				const modal = modalHTML(`Del${menu}`, 'Delete', `Del${menu}`, form);
				document.querySelector('#modal').innerHTML = modal;
				$(`#modalDel${menu}`).modal();
			} else {
				showSnackError(res.remarks);
				dismisLoading();
			}
		})
		.catch(e => console.log(e));
}
function showSnackError(text) {
	iziToast.error({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
}
function success(text, fungsi, target = null) {
	id = document.querySelector('#header').dataset.id;
	iziToast.success({
		title: 'Info',
		message: text,
		position: 'topRight'
	});
	fungsi(target, id);
    $('.modal').modal('hide');
}
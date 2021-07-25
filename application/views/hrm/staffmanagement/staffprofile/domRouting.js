document.querySelector('#nav').addEventListener('click', e => {
    e.preventDefault();
    id = document.querySelector('#header').dataset.id;
    if(e.target.id == 'navInfo') {
        renderInfoEmployee(id);
    } else if(e.target.id == 'navPayroll') {
        renderPayroll(e.target, id)
    } else if(e.target.id == 'navPayslip') {
        renderPayslip(e.target, id)
    } else if(e.target.id == 'navBasicProfile') {
    	renderBasicProfile(e.target, id)
    } else if(e.target.id == 'navEmergencyContacts') {
    	renderEmergencyContacts(e.target, id)
    } else if(e.target.id == 'navDocuments') {
    	renderDocuments(e.target, id)
    } else if(e.target.id == 'navQualifications') {
    	renderQualifications(e.target, id)
    } else if(e.target.id == 'navWorkExperience') {
    	renderWorkExperience(e.target, id)
    } else if(e.target.id == 'navBankAccount') {
    	renderBankAccount(e.target, id);
    } else if(e.target.id == 'navFamilyMembers') {
    	renderFamilyMembers(e.target, id);
    }
});
document.querySelector('#modal').addEventListener('click', e => {
	const id = document.querySelector('#header').dataset.id;
	if(e.target.id == 'btnSaveContact') {
		saveEmergencyContact(id, e.target);
	} else if(e.target.id == 'btnSaveDocument') {
		saveDocument(id, e.target);
	} else if(e.target.id == 'btnSaveQualifications') {
		saveQualifications(id, e.target);
	} else if(e.target.id == 'btnSaveWorkExperience') {
		saveWorkExperience(id, e.target);
	} else if(e.target.id == 'btnSaveBankAccount') {
		saveBankAccount(id, e.target);
	} else if(e.target.id == 'btnSaveFamilyMembers') {
		saveFamilyMembers(id, e.target)
	} else if(e.target.id == 'btnSaveDelEmergencyContacts') {
		removeEmergencyContact(e.target);
	} else if(e.target.id == 'btnSaveDelDocuments') {
		removeDocument(e.target);
	} else if(e.target.id == 'btnSaveDelQualifications') {
		removeQualification(e.target)
	}else if(e.target.id == 'btnSaveDelWorkExperience') {
		removeWorkExperience(e.target);
	} else if(e.target.id == 'btnSaveDelBankAccount') {
		removeBankAccount(e.target);
	} else if(e.target.id == 'btnSaveDelFamilyMembers') {
		removeBankAccount(e.target);
	} else if(e.target.id == 'btnSaveStaff') {
		saveStaff(e.target);
	}
});
document.querySelector('#konten').addEventListener('click', e => {
	const id = document.querySelector('#header').dataset.id;
	if(e.target.id == 'btnAddContact') {
		modal.innerHTML = modalHTML('AddContact', 'Add Emergency Contact', 'Contact', formInputContact('add', id));
		$('#modalAddContact').modal();
	} else if(e.target.id == 'btnAddDocument') {
		modal.innerHTML = modalHTML('AddDocument', 'Add Document', 'Document', formInputDocument('add', id));
		renderTipeFileDocument();
		$('#modalAddDocument').modal();
	} else if(e.target.id == 'btnAddQualifications') {
		modal.innerHTML = modalHTML('AddQualifications', 'Add Qualification', 'Qualifications', formInputQualifications('add', id));
		$('#modalAddQualifications').modal();
	} else if(e.target.id == 'btnAddWorkExperience') {
		modal.innerHTML = modalHTML('AddWorkExperience', 'Add Work Experience', 'WorkExperience', formInputWorkExperience('add', id));
		$('#modalAddWorkExperience').modal();
	} else if(e.target.id == 'btnAddBankAccount') {
		modal.innerHTML = modalHTML('AddBankAccount', 'Add Work Experience', 'BankAccount', formInputBankAccount('add', id));
		$('#modalAddBankAccount').modal();
	} else if(e.target.id == 'btnAddFamilyMembers') {
		modal.innerHTML = modalHTML('AddFamilyMembers', 'Add Family Members', 'FamilyMembers', formInputFamilyMembers('add', id));
		renderPendidikan();
		$('#modalAddFamilyMembers').modal();
	} else if(e.target.id == 'btnAddStaff') {
		renderAddStaffModal(modal);
	} else if(e.target.id == 'btnEditStaff') {
		renderEditStaffModal(id);
	}
});
function renderEditStaffModal(id) {
	fetch(`${baseUrl}getstaffprofilebyid?id=${id}`)
		.then(res => res.json())
		.then(res => {
			const form = formInputStaff('edit', res.data);
			const html = modalHTML('EditStaff', 'Edit Staff Profile', 'Staff', form, 'modal-xl');
			data = res.data;
			modal.innerHTML = html;
			renderDaerah('provinsi', 'provinsi', 'prov_id', data.prov_id);
			renderDaerah(`kota?id_provinsi=${data.prov_id}`, 'kota_kabupaten', 'kab_id', data.kab_id);
			renderDaerah(`kecamatan?id_kota=${data.kab_id}`, 'kecamatan', 'kec_id', data.kec_id);
			renderDaerah(`kelurahan?id_kecamatan=${data.kec_id}`, 'kelurahan', 'desa_id', data.desa_id);
			renderShift(data.shift_id);
			renderPosition(data.position_id);
			renderDepartment(data.departement_id);
			renderInstansi(data.instansi_id);
			renderBranch(data.branch_id);
			renderKontrak(data.contract_id);
			$('#modalEditStaff').modal();
		})
		.catch(e => console.log(e));
}
function renderAddStaffModal(modal) {
	const form = formInputStaff('add');
	const html = modalHTML('AddStaff', 'Add Staff Profile', 'Staff', form, 'modal-xl');
	modal.innerHTML = html;
	renderDaerah('provinsi', 'provinsi', 'prov_id');
	renderShift();
	renderPosition();
	renderDepartment();
	renderInstansi();
	renderBranch();
	renderKontrak();
	$('#modalAddStaff').modal();
}
document.querySelector('#modal').addEventListener('change', e => {
	if(e.target.id == 'prov_id') {
		renderDaerah(`kota?id_provinsi=${e.target.value}`, 'kota_kabupaten', 'kab_id');
	} else if(e.target.id == 'kab_id') {
		renderDaerah(`kecamatan?id_kota=${e.target.value}`, 'kecamatan', 'kec_id');
	} else if(e.target.id == 'kec_id') {
		renderDaerah(`kelurahan?id_kecamatan=${e.target.value}`, 'kelurahan', 'desa_id');
	}
});
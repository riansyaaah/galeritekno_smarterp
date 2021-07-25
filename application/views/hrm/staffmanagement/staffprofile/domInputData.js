function removeEmergencyContact(btn) {
	remove('deleteitemcontact?', renderEmergencyContacts, 'EmergencyContacts', btn);
}
function removeDocument(btn) {
	remove('deleteItemDocument?', renderDocuments, 'Documents', btn);
}
function removeQualification(btn) {
	remove('deleteitemqualification?', renderQualifications, 'Qualifications', btn);
}
function removeWorkExperience(btn) {
	remove('deleteitemexperience?', renderWorkExperience, 'WorkExperience', btn);
}
function removeBankAccount(btn) {
	remove('deleteitembankaccount?', renderBankAccount, 'BankAccount', btn);
}
function removeBankAccount(btn) {
	remove('deleteitemfamilymember?', renderFamilyMembers, 'FamilyMembers', btn);
}
function remove(url, fungsi, menuTarget, btn) {
	const id = `id=${document.querySelector('#idItem').value}`;
	btn.innerHTML = 'Loading...';
	btn.disabled = true;
	fetch(baseUrl+url+id)
		.then(res => res.json())
		.then(res => {
			if (res.status_json) {
				const target = document.querySelector(`#nav${menuTarget}`);
				success(res.remarks, fungsi, target)
				$(`#modalDel${menuTarget}`).modal('hide');
			} else {
				btn.innerHTML = 'Gagal, Coba lagi';
				btn.disabled = false;
				showSnackError(res.remarks);
			}
		})
		.catch(e => {
			btn.innerHTML = 'Gagal, Coba lagi';
			btn.disabled = false;
		});
}
function saveFamilyMembers(idStaff, btn) {
	const nameFM = document.querySelector('#nameFamilyMember');
	const familyStatusFM = document.querySelector('#familyStatusFamilyMember');
	const birthPlaceFM = document.querySelector('#birthPlaceFamilyMember');
	const birthDateFM = document.querySelector('#birthDateFamilyMember');
	const professionFM = document.querySelector('#professionFamilyMember');
	const educationLevelFM = document.querySelector('#educationLevelFamilyMember');
	const data = {
		id: document.querySelector('#idFamilyMember').value,
		statusFM: document.querySelector('#statusFamilyMember').value,
		staffFM: idStaff,
		nameFM: nameFM.value,
		familyStatusFM: familyStatusFM.value,
		birthPlaceFM: birthPlaceFM.value,
		birthDateFM: birthDateFM.value,
		professionFM: professionFM.value,
		educationLevelFM: educationLevelFM.value
	}
	if(!data.nameFM) {
		showSnackError('The field(s) is required');
		nameFM.classList.add('is-invalid');
	} else if(!data.familyStatusFM) {
		showSnackError('The field(s) is required');
		familyStatusFM.classList.add('is-invalid');
	} else if(!data.birthPlaceFM) {
		showSnackError('The field(s) is required');
		birthPlaceFM.classList.add('is-invalid');
	} else if(!data.birthDateFM) {
		showSnackError('The field(s) is required');
		birthDateFM.classList.add('is-invalid');
	} else if(!data.professionFM) {
		showSnackError('The field(s) is required');
		professionFM.classList.add('is-invalid');
	} else if(!data.educationLevelFM) {
		showSnackError('The field(s) is required');
		educationLevelFM.classList.add('is-invalid');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navFamilyMembers');
		inputData(data, btn, 'savefamilymember?', renderFamilyMembers, target);
	}
}
function saveBankAccount(idStaff, btn) {
	const codeBA = document.querySelector('#codeBankAccount');
	const nameBA = document.querySelector('#nameBankAccount');
	const accountNoBA = document.querySelector('#accountNoBankAccount');
	const branchBA = document.querySelector('#branchBankAccount');
	const data = {
		id: document.querySelector('#idBankAccount').value,
		statusBA: document.querySelector('#statusBankAccount').value,
		staffBA: idStaff,
		codeBA: codeBA.value,
		nameBA: nameBA.value,
		accountNoBA: accountNoBA.value,
		branchBA: branchBA.value
	}
	if(!data.codeBA) {
		showSnackError('The field(s) is required');
		codeBA.classList.add('is-invalid');
	} else if(!data.nameBA) {
		showSnackError('The field(s) is required');
		nameBA.classList.add('is-invalid');
	} else if(!data.accountNoBA) {
		showSnackError('The field(s) is required');
		accountNoBA.classList.add('is-invalid');
	} else if(!data.branchBA) {
		showSnackError('The field(s) is required');
		branchBA.classList.add('is-invalid');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navBankAccount');
		inputData(data, btn, 'savestaffbankaccount?', renderBankAccount, target);
	}
}
function saveWorkExperience(idStaff, btn) {
	const companyE = document.querySelector('#companyExperience');
	const startDateE = document.querySelector('#startDateExperience');
	const finishDateE = document.querySelector('#finishDateExperience');
	const positionE = document.querySelector('#positionExperience');
	const descriptionE = document.querySelector('#descriptionExperience');
	const data = {
		id: document.querySelector('#idExperience').value,
		statusE: document.querySelector('#statusExperience').value,
		staffE: idStaff,
		companyE: companyE.value,
		startDateE: startDateE.value,
		finishDateE: finishDateE.value,
		positionE: positionE.value,
		descriptionE: descriptionE.value
	}
	if(!data.companyE) {
		showSnackError('The field(s) is required');
		companyE.classList.add('is-invalid');
	} else if(!data.startDateE) {
		showSnackError('The field(s) is required');
		startDateE.classList.add('is-invalid');
	} else if(!data.finishDateE) {
		showSnackError('The field(s) is required');
		finishDateE.classList.add('is-invalid');
	} else if(!data.positionE) {
		showSnackError('The field(s) is required');
		positionE.classList.add('is-invalid');
	} else if(!data.descriptionE) {
		showSnackError('The field(s) is required');
		descriptionE.classList.add('is-invalid');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navWorkExperience');
		inputData(data, btn, 'savestaffexperience?', renderWorkExperience, target);
	}
}
function saveQualifications(idStaff, btn) {
	const schoolQ = document.querySelector('#schoolQualification');
	const educationLevelQ = document.querySelector('#educationLevelQualification');
	const firstMonthQ = document.querySelector('#firstMonthQualification');
	const firstYearQ = document.querySelector('#firstYearQualification');
	const lastMonthQ = document.querySelector('#lastMonthQualification');
	const lastYearQ = document.querySelector('#lastYearQualification');
	const data = {
		id: document.querySelector('#idQualification').value,
		statusQ: document.querySelector('#statusQualification').value,
		staffQ: idStaff,
		schoolQ: schoolQ.value,
		educationLevelQ: educationLevelQ.value,
		firstMonthQ: firstMonthQ.value,
		firstYearQ: firstYearQ.value,
		lastMonthQ: lastMonthQ.value,
		lastYearQ: lastYearQ.value
	}
	if(!data.schoolQ) {
		showSnackError('The field(s) is required');
		schoolQ.classList.add('is-invalid');
	} else if(!data.educationLevelQ){
		showSnackError('The field(s) is required');
		educationLevelQ.classList.add('is-invalid');
	} else if(!data.firstMonthQ) {
		showSnackError('The field(s) is required');
		firstMonthQ.classList.add('is-invalid');
	} else if(!data.firstYearQ) {
		showSnackError('The field(s) is required');
		firstYearQ.classList.add('is-invalid');
	} else if(!data.lastMonthQ) {
		showSnackError('The field(s) is required');
		lastMonthQ.classList.add('is-invalid');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navQualifications');
		inputData(data, btn, 'savestaffqualification?', renderQualifications, target);
	}
}
function saveDocument(idStaff, btn) {
	const staffD = document.querySelector('#staffDocument');
	const typeD = document.querySelector('#typeDocument');
	const nameD = document.querySelector('#nameDocument');
	const descriptionD = document.querySelector('#descriptionDocument');
	const data = {
		id: document.querySelector('#idDocument').value,
		statusD: document.querySelector('#statusDocument').value,
		staffD: idStaff,
		typeD: typeD.value,
		nameD: nameD.value,
		descriptionD: descriptionD.value
	}
	if(!data.typeD){
		showSnackError('The field(s) is required');
		typeD.classList.add('is-invalid');
	} else if(!data.nameD) {
		showSnackError('The field(s) is required');
		nameD.classList.add('is-invalid');
	} else if(!data.descriptionD) {
		showSnackError('The field(s) is required');
		descriptionD.classList.add('is-invalid');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navDocuments');
		inputData(data, btn, 'savestaffdocument?', renderDocuments, target);
	}
}
function saveEmergencyContact(idStaff, btn) {
	const nameEC = document.querySelector('#nameEmergencyContact');
	const relationEC = document.querySelector('#relationEmergencyContact');
	const phoneEC = document.querySelector('#phoneEmergencyContact');
	const emailEC = document.querySelector('#emailEmergencyContact');
	const data = {
		id: document.querySelector('#idEmergencyContact').value,
		statusEC: document.querySelector('#statusEmergencyContact').value,
		staffEC: idStaff,
		nameEC: nameEC.value,
		relationEC: relationEC.value,
		phoneEC: phoneEC.value,
		emailEC: emailEC.value
	}
	if(!data.nameEC) {
		showSnackError('The field(s) is required');
		nameEC.classList.add('is-invalid');
	} else if(!data.relationEC) {
		showSnackError('The field(s) is required');
		relationEC.classList.add('is-invalid');
	} else if(!data.phoneEC) {
		showSnackError('The field(s) is required');
		phoneEC.classList.add('is-invalid');
	} else if(!data.emailEC) {
		showSnackError('The field(s) is required');
		emailEC.classList.add('is-invalid');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navEmergencyContacts');
		inputData(data, btn, 'savestaffemergencycontact?', renderEmergencyContacts, target);
	}
}
function inputData(data, btn, url, fungsi, target = null) {
	data = new URLSearchParams(data).toString();
	fetch(baseUrl+url+data)
		.then(res => res.json())
		.then(res => {
			showLoading();
			if (res.status_json) {
				$('#addEmergencyContact').modal('hide');
				dismisLoading();
				success(res.remarks, fungsi, target);
			} else {
				btn.innerHTML = 'Save';
				btn.disabled = false;
				dismisLoading();
				showSnackError(res.remarks);
			}
		})
		.catch(e => {
			console.log(e);
			dismisLoading();
			btn.innerHTML = 'Failed, Try again';
			btn.disabled = false;
		});
}
function saveStaff(btn) {
	const firstName = document.querySelector('#first_name');
	const data = {
		status: document.querySelector('#statusdata').value,
		code: document.querySelector('#code').value,
		id_personel: document.querySelector('#id_personel').value,
		first_name: firstName.value,
		last_name: document.querySelector('#last_name').value,
		is_active: (document.querySelector('#edit_is_active').checked)? 1 : 0,
		email: document.querySelector('#email').value,
		phone: document.querySelector('#phone').value,
		address: document.querySelector('#address').value,
		birth_place: document.querySelector('#birth_place').value,
		birth_day: document.querySelector('#birth_day').value,
		gender: (document.querySelector('#edit_jenis_kelamin_l').checked)? 'L' : 'P',
		marital_status: (document.querySelector('#marital_status_s').checked)? 'Single' : 'Married',
		prov_id: document.querySelector('#prov_id').value,
		kab_id: document.querySelector('#kab_id').value,
		kec_id: document.querySelector('#kec_id').value,
		desa_id: document.querySelector('#desa_id').value,
		postal_code: document.querySelector('#postal_code').value,
		shift_id: document.querySelector('#shift_id').value,
		position_id: document.querySelector('#position_id').value,
		departement_id: document.querySelector('#departement_id').value,
		date_of_joining: document.querySelector('#dateofjoining').value,
		contract_id: document.querySelector('#contract_id').value,
		instansi_id: document.querySelector('#instansi_id').value,
		branch_id: document.querySelector('#branch_id').value,
		basic_salary: document.querySelector('#basic_salary').value
	}
	if(!data.first_name) {
		showSnackError('This field is required');
	} else {
		btn.innerHTML = 'Loading...';
		btn.disabled = true;
		const target = document.querySelector('#navBasicProfile');
		if(!target) {
			inputData(data, btn, 'savestaffprofile?', renderHalamanUtama);
		} else {
			inputData(data, btn, 'savestaffprofile?', renderBasicProfile, target);
		}
	}
}
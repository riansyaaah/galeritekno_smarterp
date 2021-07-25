function headerUtamaHTML(title) {
	return `<h4>${title}</h4><hr>`;
}
function backHTML() {
    return `<button onclick="backAction()" class="btn btn-warning">
        <i class="fas fa-backward"></i> Kembali</button>&nbsp;
    <div class="ml-3 mt-2">
        <h5 id="judulBack"></h5>
    </div>`;
}
function tableUtamaHTML() {
	return `<button id="btnAddStaff" class="btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Staff
	</button>
	<div class="table-responsive">
		<table class="table table-hover table-bordered fullTable" id="tableUtama">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Photo</th>
					<th>ID</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Position</th>
					<th style="width: 25%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function formDelete(id, namaItem) {
	return `<input type="hidden" id="idItem" value="${id}">
	<p>Are you sure to delete ${namaItem}?</p>`;
}
function navPersonalHTML() {
	return `<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" href="#" id="navBasicProfile">Basic Profile</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" id="navEmergencyContacts">Emergency Contacts</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" id="navDocuments">Documents</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" id="navQualifications">Qualifications</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" id="navWorkExperience">Work Experience</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" id="navBankAccount">Bank Account</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" id="navFamilyMembers">Family Members</a>
		</li>
	</ul>`;
}
function familyMembersHTML() {
	return `<button id="btnAddFamilyMembers" class="mt-2 btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Family Member
	</button>
	<div class="table-responsive">
		<table class="table table-hover fullTable table-bordered" id="tableFamilyMembers">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Name</th>
					<th>Status</th>
					<th>Birth Date, Place</th>
					<th>Education Level</th>
					<th>Profession</th>
					<th style="width: 20%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function bankAccountHTML() {
	return `<button id="btnAddBankAccount" class="mt-2 btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Bank Account
	</button>
	<div class="table-responsive">
		<table class="table table-hover fullTable table-bordered" id="tableBankAccount">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Account No</th>
					<th>Bank Name</th>
					<th style="width: 12%;">Bank Code</th>
					<th>Bank Branch</th>
					<th style="width: 18%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function workExperienceHTML() {
	return `<button id="btnAddWorkExperience" class="mt-2 btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Experience
	</button>
	<div class="table-responsive">
		<table class="table table-hover fullTable table-bordered" id="tableWorkExperience">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Company</th>
					<th>Position</th>
					<th>Periode</th>
					<th>Description</th>
					<th style="width: 18%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function qualificationsHTML() {
	return `<button id="btnAddQualifications" class="mt-2 btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Qualification
	</button>
	<div class="table-responsive">
		<table class="table table-hover fullTable table-bordered" id="tableQualifications">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Instansi</th>
					<th>Level</th>
					<th>Major</th>
					<th>Periode</th>
					<th style="width: 20%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function documentsHTML() {
	return `<button id="btnAddDocument" class="mt-2 btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Document
	</button>
	<div class="table-responsive">
		<table class="table table-hover fullTable table-bordered" id="tableDocuments">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Type</th>
					<th>Document</th>
					<th style="width: 10%;">Download</th>
					<th style="width: 20%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function emergencyContactsHTML() {
	return `<button id="btnAddContact" class="mt-2 btn btn-primary btn-sm mb-3">
		<i class="fa fa-plus"></i> Add Contact
	</button>
	<div class="table-responsive">
		<table class="table table-hover fullTable table-bordered" id="tableEmergencyContacts">
			<thead>
				<tr class="text-center">
					<th style="width: 5%;">No</th>
					<th>Name</th>
					<th>Relation</th>
					<th>Phone</th>
					<th>Email</th>
					<th style="width: 20%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function infoPersonalHTML(data) {
	return `
	<div class="row">
		<div class="col-md-3">
			<div class="text-center mt-5">
				<img src="https://www.jing.fm/clipimg/full/190-1907810_rocket-raccoon-clipart-baby-groot-cute-chibi-marvel.png" class="img-fluid" alt="Responsive image" style="max-height: 350px;">
			</div>
		</div>
		<div class="col-md-9">
			<table class="table table-hover">
				<tbody>
					<tr>
						<th width="200px">First Name</th>
						<td width=5px>:</td>
						<td scope="row" class="text-left">${data.first_name}</td>
					</tr>
					<tr>
						<th>Last Name</th>
						<td>:</td>
						<td class="text-left">${data.last_name}</td>
					</tr>
					<tr>
						<th>Gender</th>
						<td>:</td>
						<td class="text-left">${data.gender}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>:</td>
						<td class="text-left">${data.email}</td>
					</tr>
					<tr>
						<th>Phone</th>
						<td>:</td>
						<td class="text-left">${data.phone}</td>
					</tr>
					<tr>
						<th>Address</th>
						<td>:</td>
						<td class="text-left">${data.address}</td>
					</tr>
					<tr>
						<th>Postal Code</th>
						<td>:</td>
						<td class="text-left">${data.postal_code}</td>
					</tr>
					<tr>
						<th>Birth Date, Place</th>
						<td>:</td>
						<td class="text-left">${data.birth_day}, ${data.birth_place}</td>
					</tr>
					<tr>
						<th>Marital Status</th>
						<td>:</td>
						<td class="text-left">${data.marital_status}</td>
					</tr>
				</tbody>
			</table>
			<button class="btn btn-info btn-sm float-right" id="btnEditStaff">
				<i class="fa fa-edit"></i> Edit Staff
			</button>
		</div>
	</div>`;
}
function navHTML() {
    return `<ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" id="navInfo" href="#">Employee Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="navPayroll" href="#">Payroll Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="navPayslip" href="#">Payslip</a>
        </li>
    </ul>`;
}
function infoEmployeeHTML(data) {
    return `<div class="row">
        <div class="col-md-3">
            <div class="text-center mt-5">
                <img src="https://www.jing.fm/clipimg/full/190-1907810_rocket-raccoon-clipart-baby-groot-cute-chibi-marvel.png" class="img-fluid" alt="Responsive image" style="max-height: 350px;">
            </div>
        </div>
        <div class="col-md-9">
            <table class="table table-hover">
                <tr>
                    <th width="200px">First Name</th>
                    <td width=5px>:</td>
                    <td class="text-left">${data.first_name}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>:</td>
                    <td class="text-left">${data.last_name}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>:</td>
                    <td class="text-left">${(data.gender == 'P')? 'Perempuan' : 'Laki - Laki'}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td class="text-left">${data.email}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>:</td>
                    <td class="text-left">${data.phone}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>:</td>
                    <td class="text-left">${data.address}</td>
                </tr>
                <tr>
                    <th>Postal Code</th>
                    <td>:</td>
                    <td class="text-left">${data.postal_code}</td>
                </tr>
                <tr>
                    <th>Birth Date, Place</th>
                    <td>:</td>
                    <td class="text-left">${data.birth_day}, ${data.birth_place}</td>
                </tr>
                <tr>
                    <th>Marital Status</th>
                    <td>:</td>
                    <td class="text-left">${data.marital_status}</td>
                </tr>
            </table>
        </div>
    </div>`;
}
function payrollHTML() {
    return `<div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tablePayroll" style="width: 100%;">
                <thead>
                    <tr class="text-center">
                        <th style="width: 5%;">No</th>
                        <th style="width: 5%;">Year</th>
                        <th style="width: 5%;">Month</th>
                        <th>Basic Sallary</th>
                        <th>Incentive</th>
                        <th>Allowance</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>`;
}
function payslipHTML(data) {
    return `<div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tablePayslip">
                <thead>
                    <tr class="text-center">
                        <th style="width: 5%;">No</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th style="width: 15%;"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>`;
}
function modalHTML(idModal, judul, idBtnSave, form, ukuran = '') {
	return `<div class="modal fade" id="modal${idModal}" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered ${ukuran}" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">${judul}</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">${form}</div>
	            <div class="modal-footer bg-whitesmoke br">
	                <button class="btn btn-primary" type="button" id="btnSave${idBtnSave}"><i class="fa fa-check"></i> ${(judul.includes('Delete'))? 'Confirm' : 'Save'}</button>
	                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	            </div>
	        </div>
	    </div>
	</div>`;
}
function formInputBankAccount(status, id, data = null) {
	return `<input type="hidden" id="statusBankAccount" value="${status}">
    <input type="hidden" id="idBankAccount" value="${(!data)? '' : data.id}">
    <input type="hidden" id="staffBankAccount" value="${id}">
    <div class="form-group">
        <div class="section-title">Bank Code </div>
        <input value="${(!data)? '' : data.bank_code}" type="number" class="form-control form-control-sm" id="codeBankAccount">
    </div>
    <div class="form-group">
        <div class="section-title">Bank Name </div>
        <input value="${(!data)? '' : data.bank_name}" type="text" class="form-control form-control-sm" id="nameBankAccount">
    </div>
    <div class="form-group">
        <div class="section-title">Account Number </div>
        <input value="${(!data)? '' : data.account_no}" type="number" class="form-control form-control-sm" id="accountNoBankAccount">
    </div>
    <div class="form-group">
        <div class="section-title">Bank Branch </div>
        <input value="${(!data)? '' : data.bank_branch}" type="text" class="form-control form-control-sm" id="branchBankAccount">
    </div>`;
}
function formInputWorkExperience(status, id, data = null) {
	return `<input type="hidden" id="statusExperience" value="${status}">
    <input type="hidden" id="idExperience" value="${(!data)? '' : data.id}">
    <input type="hidden" id="staffExperience" value="${id}">
    <div class="form-group">
        <div class="section-title">Position </div>
        <input value="${(!data)? '' : data.position}" type="text" class="form-control form-control-sm" id="positionExperience">
    </div>
    <div class="form-group">
        <div class="section-title">Company</div>
        <input value="${(!data)? '' : data.company}" type="text" class="form-control form-control-sm" id="companyExperience">
    </div>
    <div class="form-group">
        <div class="section-title">Start Date</div>
        <input value="${(!data)? '' : data.start_date}" type="date" class="form-control form-control-sm" id="startDateExperience">
    </div>
    <div class="form-group">
        <div class="section-title">Finish Date</div>
        <input value="${(!data)? '' : data.finish_date}" type="date" class="form-control form-control-sm" id="finishDateExperience">
    </div>
    <div class="form-group">
        <div class="section-title">Description</div>
        <input value="${(!data)? '' : data.description}" type="text" class="form-control form-control-sm" id="descriptionExperience">
    </div>`;
}
function formInputQualifications(status, id, data = null) {
	return `<input type="hidden" id="statusQualification" value="${status}">
    <input type="hidden" id="idQualification" value="${(!data)? '' : data.id}">
    <input type="hidden" id="staffQualification" value="${id}">
    <div class="form-group">
        <div class="section-title">School</div>
        <input value="${(!data)? '' : data.school}" type="text" class="form-control form-control-sm" id="schoolQualification">
    </div>
    <div class="form-group">
        <div class="section-title">Education Level</div>
        <input value="${(!data)? '' : data.education_level}" type="text" class="form-control form-control-sm" id="educationLevelQualification">
    </div>
    <div class="form-group">
        <div class="section-title">First Month</div>
        <input value="${(!data)? '' : data.first_month}" type="text" class="form-control form-control-sm" id="firstMonthQualification">
    </div>
    <div class="form-group">
        <div class="section-title">First Year</div>
        <input value="${(!data)? '' : data.first_year}"  type="text" class="form-control form-control-sm" id="firstYearQualification">
    </div>
    <div class="form-group">
        <div class="section-title">Last Month</div>
        <input value="${(!data)? '' : data.last_month}"  type="text" class="form-control form-control-sm" id="lastMonthQualification">
    </div>
    <div class="form-group">
        <div class="section-title">Last Year</div>
        <input value="${(!data)? '' : data.last_year}" type="text" class="form-control form-control-sm" id="lastYearQualification">
    </div>`;
}
function formInputDocument(status, id, data = null) {
	return `<input type="hidden" id="statusDocument" value="${status}">
	<input type="hidden" id="idDocument" value="${(!data)? '' : data.id}">
	<input type="hidden" id="staffDocument" value="${id}">
	<div class="form-group row">
		<div class="col-md-6">
			<div class="section-title">Document Type</div>
			<select name="typeDocument" class="custom-select" id="typeDocument">
				<option value="">Please Select</option>
			</select>
		</div>
		<div class="col-md-6">
			<div class="section-title">Document</div>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="nameDocument" value="${(!data)? '' : data.document_name}">
				<label class="custom-file-label" for="nameDocument">Choose File</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="section-title">Description</div>
		<textarea class="form-control" name="descriptionDocument" id="descriptionDocument" cols="30" rows="10">${(!data)? '' : data.description}</textarea>
	</div>`;
}
function formInputFamilyMembers(status, id, data = null) {
	return `<input type="hidden" id="statusFamilyMember" value="${status}">
    <input type="hidden" id="idFamilyMember" value="${(!data)? '' : data.id}">
    <input type="hidden" id="staffFamilyMember" value="${id}">
    <div class="form-group">
        <div class="section-title">Name</div>
        <input value="${(!data)? '' : data.name}" type="text" class="form-control form-control-sm" id="nameFamilyMember">
    </div>
    <div class="form-group">
        <div class="section-title">Status</div>
        <input value="${(!data)? '' : data.family_status}" type="text" class="form-control form-control-sm" placeholder="example: Ayah" id="familyStatusFamilyMember">
    </div>
    <div class="form-group">
        <div class="section-title">Birth Place</div>
        <input value="${(!data)? '' : data.birth_place}" type="text" class="form-control form-control-sm" placeholder="example: Jakarta" id="birthPlaceFamilyMember">
    </div>
    <div class="form-group">
        <div class="section-title">Birth Date</div>
        <input value="${(!data)? '' : data.birth_date}" type="date" class="form-control form-control-sm" id="birthDateFamilyMember">
    </div>
    <div class="form-group">
        <div class="section-title">Education Level</div>
        <select class="custom-select custom-select-sm" name="educationLevelFamilyMember" id="educationLevelFamilyMember" class="form-control">
            <option value="">Please Select</option>
        </select>
    </div>
    <div class="form-group">
        <div class="section-title">Profession</div>
        <input value="${(!data)? '' : data.profession}" type="text" class="form-control form-control-sm" placeholder="example: Guru" id="professionFamilyMember">
    </div>`;
}
function formInputContact(status, id, data = null) {
	return `<input type="hidden" id="statusEmergencyContact" value="${status}">
	<input type="hidden" id="staffEmergencyContact" value="${id}">
    <input type="hidden" id="idEmergencyContact" value="${(!data)? '' : data.id}">
    <div class="form-group">
        <div class="section-title">Name </div>
        <input value="${(!data)? '' : data.name}" type="text" class="form-control form-control-sm" id="nameEmergencyContact">
    </div>
    <div class="form-group">
        <div class="section-title">Relation</div>
        <input value="${(!data)? '' : data.relation}" type="text" class="form-control form-control-sm" id="relationEmergencyContact">
    </div>
    <div class="form-group">
        <div class="section-title">Phone</div>
        <input value="${(!data)? '' : data.phone}" type="text" class="form-control form-control-sm" id="phoneEmergencyContact">
    </div>
    <div class="form-group">
        <div class="section-title">Email</div>
        <input value="${(!data)? '' : data.email}" type="email" class="form-control form-control-sm" id="emailEmergencyContact">
    </div>`;
}
function formInputStaff(status, data = null) {
	return `<div class="form-group">
		<input type="hidden" id="statusdata" value="${status}">
        <input type="hidden" id="code" value="${(!data)? '' : data.id}">
        <div class="row">
            <div class="col-md">
            	<lable class="section-title">Gender : </lable>
                <div class="pretty p-icon p-curve p-rotate ml-5">
                    <input ${(!data)? 'checked' : ((data.gender == 'Perempuan')? '' : 'checked')} type="radio" name="edit_jenis_kelamin" id="edit_jenis_kelamin_l" value="L">
                    <div class="state p-success-o">
                        <i class="icon material-icons">done</i>
                        <label> Male</label>
                    </div>
                </div>
                <div class="pretty p-icon p-curve p-rotate">
                    <input ${(!data)? '' : ((data.gender == 'Perempuan')? 'checked' : '')} type="radio" name="edit_jenis_kelamin" id="edit_jenis_kelamin_p" value="P">
                    <div class="state p-success-o">
                        <i class="icon material-icons">done</i>
                        <label> Female</label>
                    </div>
                </div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<lable class="section-title">Marital Status : </lable>
                <div class="pretty p-icon p-curve p-rotate ml-3">
                    <input ${(!data)? 'checked' : ((data.marital_status == 'Single')? 'checked' : '')} type="radio" name="marital_status" id="marital_status_s" value="Single">
                    <div class="state p-success-o">
                        <i class="icon material-icons">done</i>
                        <label> Single</label>
                    </div>
                </div>
                <div class="pretty p-icon p-curve p-rotate">
                    <input ${(!data)? '' : ((data.marital_status == 'Single')? '' : 'checked')} type="radio" name="marital_status" id="marital_status_m" value="Married">
                    <div class="state p-success-o">
                        <i class="icon material-icons">done</i>
                        <label> Married </label>
                    </div>
                </div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">First Name</div>
                <input value="${(!data)? '' : data.first_name}" type="text" class="form-control form-sm" id="first_name">
        	</div>
        	<div class="col-md">
        		<div class="section-title">Last Name</div>
                <input value="${(!data)? '' : data.last_name}" type="text" class="form-control form-sm" id="last_name">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">Personel ID</div>
                <input value="${(!data)? '' : data.id_personel}" type="text" class="form-control form-sm" id="id_personel">
        	</div>
        	<div class="col-md">
        		<div class="section-title">Birth Place</div>
                <input value="${(!data)? '' : data.birth_place}" type="text" class="form-control form-sm" id="birth_place">
        	</div>
        	<div class="col-md">
        		<div class="section-title">Birth Day</div>
                <input value="${(!data)? '' : data.birth_day}" type="date" class="form-control form-sm" id="birth_day">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">Email </div>
                <input value="${(!data)? '' : data.email}" type="email" class="form-control form-sm" id="email">
        	</div>
        	<div class="col-md">
        		<div class="section-title">Phone</div>
                <input value="${(!data)? '' : data.phone}" type="text" class="form-control form-sm" id="phone">
        	</div>
        	<div class="col-md">
        		<div class="section-title">Postal Code</div>
                <input value="${(!data)? '' : data.postal_code}" type="text" class="form-control" id="postal_code">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">Address</div>
                <textarea name="address" class="form-control" id="address" cols="30" rows="10">${(!data)? '' : data.address}</textarea>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">Province</div>
                <select id="prov_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md">
        		<div class="section-title">City</div>
                <select id="kab_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md">
        		<div class="section-title">District</div>
                <select id="kec_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md">
        		<div class="section-title">Village </div>
                <select id="desa_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        </div><hr>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">Shift</div>
                <select id="shift_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md">
        		<div class="section-title">Position</div>
                <select id="position_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md">
        		<div class="section-title">Departement</div>
                <select id="departement_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-4">
        		<div class="section-title">Date of Joining</div>
                <input value="${(!data)? '' : data.date_of_joining}" type="date" class="form-control" id="dateofjoining">
        	</div>
        	<div class="col-md-4">
        		<div class="section-title">Contract</div>
                <select class="custom-select" id="contract_id">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md-4">
        		<div class="section-title">Basic Salary</div>
                <input value="${(!data)? '' : data.basic_salary}" type="text" class="form-control" id="basic_salary">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<div class="section-title">Instansi</div>
                <select id="instansi_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        	<div class="col-md">
        		<div class="section-title">Branch</div>
                <select id="branch_id" class="custom-select">
                	<option value="">Please Select</option>
                </select>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md">
        		<span class="section-title">Set Aktif </span>
                <label class="custom-switch" style="margin-top: 20px !important;">
                    <input type="checkbox" ${(!data)? 'checked' : ((data.status == 1)? 'checked' : '')} name="custom-switch-checkbox" id="edit_is_active" class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description" id="label_is_active"></span>
                </label>
        	</div>
        </div>
	</div>`;
}

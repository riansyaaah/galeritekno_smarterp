function dataTableUtama() {
	$('#tableUtama').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getStaffProfile`,
			dataSrc: 'data'
		},
		columns: [
			{"data": 'no'},
			{"data": 'photo'},
			{"data": 'id'},
			{"data": 'first_name'},
			{"data": 'phone'},
			{"data": 'position_id'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [1, 6]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
            $('td', row).eq(6).addClass('text-center');
        }
	});
}
function dataFamilyMembers(id) {
	dataPost = {staff_id: id}
	$('#tableFamilyMembers').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getfamilymembersbystaffid`,
			type: 'POST',
			dataType: 'json',
			data: dataPost,
			dataSrc: 'data',
		},
		columns: [
			{"data": 'no',},
			{"data": 'name'},
			{"data": 'status'},
			{"data": 'birth_place_date'},
			{"data": 'education_level'},
			{"data": 'profession'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [6]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        	$('td', row).eq(6).addClass('text-center');
        }
	});
}
function dataBankAccount(id) {
	dataPost = {staff_id: id}
	$('#tableBankAccount').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getbankaccountbystaffid`,
			type: 'POST',
			dataType: 'json',
			data: dataPost,
			dataSrc: 'data',
		},
		columns: [
			{"data": 'no'},
			{"data": 'account_no'},
			{"data": 'bank_name'},
			{"data": 'bank_code'},
			{"data": 'bank_branch'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [5]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(1).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        }
	});
}
function dataWorkExperience(id) {
	dataPost = {staff_id: id}
	$('#tableWorkExperience').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getexperiencebystaffid`,
			type: 'POST',
			dataType: 'json',
			data: dataPost,
			dataSrc: 'data',
		},
		columns: [
			{"data": 'no'},
			{"data": 'company'},
			{"data": 'position'},
			{"data": 'periode'},
			{"data": 'description'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [5]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        }
	});
}
function dataQualifications(id) {
	dataPost = {staff_id: id}
	$('#tableQualifications').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getqualificationbystaffid`,
			type: 'POST',
			dataType: 'json',
			data: dataPost,
			dataSrc: 'data',
		},
		columns: [
			{"data": 'no'},
			{"data": 'school'},
			{"data": 'education_level'},
			{"data": 'major'},
			{"data": 'periode'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [5]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(2).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        }
	});
}
function dataDocuments(id) {
	dataPost = {staff_id: id}
	$('#tableDocuments').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getdocumentsbystaffid`,
			type: 'POST',
			dataType: 'json',
			data: dataPost,
			dataSrc: 'data',
		},
		columns: [
			{"data": 'no'},
			{"data": 'type'},
			{"data": 'name'},
			{"data": 'url'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [3, 4]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(3).addClass('text-center');
        	$('td', row).eq(4).addClass('text-center');
        }
	});
}
function dataEmergencyContacts(id) {
	dataPost = {staff_id: id}
	$('#tableEmergencyContacts').dataTable({
		destroy: true,
		ajax: {
			url: `${baseUrl}getcontactsbystaffid`,
			type: 'POST',
			dataType: 'json',
			data: dataPost,
			dataSrc: 'data',
		},
		columns: [
			{"data": 'no'},
			{"data": 'name'},
			{"data": 'relation'},
			{"data": 'email'},
			{"data": 'phone'},
			{"data": 'option'}
		],
		"columnDefs": [{
			"sortable": false,
			"targets": [5]
		}],
        "createdRow": (row, data, index) => {
        	$('td', row).eq(0).addClass('text-center');
        	$('td', row).eq(5).addClass('text-center');
        }
	});
}
function dataPayroll(id) {
    $('#tablePayroll').dataTable({
        destroy: true,
        bInfo: false,
        ajax: {
            url: `${baseUrl}getpayroll?id=${id}`,
            dataSrc: 'data'
        },
        columns: [
            {"data": 'no'},
            {"data": 'year'},
            {"data": 'month'},
            {
                "data": 'gapok',
                render: $.fn.dataTable.render.number('.', ',', 0)
            },
            {
                "data": 'insentif',
                render: $.fn.dataTable.render.number('.', ',', 0)
            },
            {
                "data": 'tunjangan',
                render: $.fn.dataTable.render.number('.', ',', 0)
            },
            {
                "data": 'total',
                render: $.fn.dataTable.render.number('.', ',', 0)
            }
        ],
        "columnDefs": [
            {
                "sortable": false,
                "targets": [3, 4, 5, 6]
            }
        ],
        "createdRow": (row, data, index) => {
            $('td', row).eq(0).addClass('text-center');
            $('td', row).eq(1).addClass('text-center');
            $('td', row).eq(2).addClass('text-center');
            $('td', row).eq(3).addClass('text-right');
            $('td', row).eq(4).addClass('text-right');
            $('td', row).eq(5).addClass('text-right');
            $('td', row).eq(6).addClass('text-right');
        }
    });
}
function dataPayslip(id) {
    $('#tablePayslip').dataTable({
        destroy: true,
        bInfo: false,
        ajax: {
            url: `${baseUrl}getpayslip?id=${id}`,
            dataSrc: 'data'
        },
        columns: [
            {"data": 'no'},
            {"data": 'year'},
            {"data": 'month'},
            {"data": 'btn'}
        ],
        "columnDefs": [
            {
                "sortable": false,
                "targets": [3]
            }
        ],
        "createdRow": (row, data, index) => {
            $('td', row).eq(0).addClass('text-center');
            $('td', row).eq(1).addClass('text-center');
            $('td', row).eq(2).addClass('text-center');
            $('td', row).eq(3).addClass('text-center');
        }
    });
}

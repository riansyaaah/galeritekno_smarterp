function dataTableRequest() {
    $('#tableUtama').dataTable({
        destroy: true,
        ajax: {
            url: `${baseUrl}getallitem`,
            dataSrc: 'data'
        },
        columns: [
            {"data": 'itemmaster'},
            {"data": 'besar'},
            {"data": 'kecil'},
            {"data": 'id'},
            {"data": 'btn'}
        ],
        "columnDefs": [{
            "sortable": false,
            "targets": [1, 2, 4]
        }],
        "createdRow": (row, data, index) => {
            $('td', row).eq(1).addClass('text-center');
            $('td', row).eq(2).addClass('text-center');
            $('td', row).eq(3).addClass('hidetd');
            $('td', row).eq(4).addClass('text-center');
        },
        "order": [
        	[3, 'desc']
        ]
    });
}
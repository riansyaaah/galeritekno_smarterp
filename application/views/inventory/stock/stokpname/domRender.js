function renderAwal() {
    document.querySelector('#konten').innerHTML = tableUtamaHTML();
    dataTableRequest();
}
function renderModalOpname(id) {
    fetch(`${baseUrl}getitem?id=${id}`)
        .then(res => res.json())
        .then(res => {
            const body = modalOpnameHTML(res.data);
            const html = modalHTML('modalAdjust', 'Opname', 'btnSaveOpname', body);
            document.querySelector('#modal').innerHTML = html;
            $('#modalAdjust').modal();
        })
        .catch(e => console.log(e));
}
function renderBtnSaveOpname() {
    const tanggal = document.querySelector('#tanggal').value;
    const realStock = document.querySelector('#realStock').value;
    btn = document.querySelector('#btnSaveOpname');
    (tanggal && realStock)? btn.removeAttribute('disabled') : btn.setAttribute('disabled', '');
}
function showSnackError(text) {
    iziToast.error({
        title: 'Info',
        message: text,
        position: 'topRight'
    });
}
function success(text, aksi) {
    Swal.fire({
        title: 'Info',
        html: text,
        type: "success",
        confirmButtonText: 'Ok',
        confirmButtonColor: "#46b654",
    }).then((result) => {
        aksi();
    })
}
function aksiSaveOpname() {
    $('#modalAdjust').modal('hide');
    dataTableRequest();
    document.querySelector('#modal').innerHTML = '';
}
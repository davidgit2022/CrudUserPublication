<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-publication').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('publications.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },

                {
                    data: 'content',
                    name: 'content'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });

        /* Show Modal New publication */
        $('.float-sm-end .btn-success').on('click', (event) => {
            $('#theModal').modal('show');
            $('#titleModal').html('CREAR PUBLICACIÓN')
            $('#btnSave').show();
            $('#btnUpdate').hide();
        });

        /* Close modal */
        $('.btnClose').on('click', (event) => {
            cancel()
        });

        /* Save publication */
        $('#btnSave').on('click', (event) => {
            let formData = new FormData($('#publicationForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('publications.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    cancel();
                    let tablePublication = $('#table-publication').DataTable();
                    tablePublication.ajax.reload();
                    toastr.clear,
                    toastr.success('Publicación creada existosamente.')
                    $('.btnSave').attr("disabled", true);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            })
        });

        /* Update publication */
        $('#btnUpdate').on('click', (event) => {
            let formData = new FormData($('#publicationForm')[0]);
            let id = $('#id').val();
            $.ajax({
                type: "POST",
                url: "publications/update/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    cancel();
                    let tablePublication = $('#table-publication').DataTable();
                    tablePublication.ajax.reload();
                    toastr.clear,
                    toastr.success('Ciudad actualizada existosamente.')
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            })
        })
    });

    /* function edit  */
    function editFun(id) {
        $.ajax({
            type: "GET",
            url: "publications/edit/" + id,
            dataType: "json",
            success: function(res) {
                $('#theModal').modal('show');
                $('#id').val(res.id);
                $('#title').val(res.title)
                $('#content').val(res.content);
                $('#titleModal').html('EDITAR PUBLICACIÓN ')
                $('#btnUpdate').show();
                $('#btnSave').hide();
                
            }
        })
    };

    /* function delete */
    function deleteFunc(id) {
        Swal.fire({
            title: 'Esta seguro?',
            text: "CONFIRMAS ELIMINAR EL REGISTRO!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borralo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "publications/delete/" + id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(res) {
                        toastr.clear,
                        toastr.success('Publicación eliminada existosamente.')
                        let tableCity = $('#table-publication').DataTable();
                        tableCity.ajax.reload();
                    }
                })

            }
        })
    };

    /* function cancel */
    function cancel() {
        $('#theModal').modal('hide');
        resetInputFields();
    };

    /* function clearFields */
    function resetInputFields() {
        $('#publicationForm')[0].reset();
        $('.error-message').hide();
    };

    /* function show Errors */

    function showErrors(errors) {
        for (const error in errors) {
            let errorSpan = $('#' + error + 'Error');
            errorSpan.text(errors[error][0]);
            errorSpan.show();
        }
    };

</script>
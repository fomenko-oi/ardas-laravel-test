import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'

require('./bootstrap');

$(document).ready(() => {
    $('form.product-remove').submit(e => {
        const form = $(e.target);

        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (!result.isConfirmed) {
                return
            }

            axios.delete(form.attr('action'), form.serialize()).then(({data}) => {
                if (data.success) {
                    form.closest('tr').remove();
                    Swal.fire('Deleted!', 'The product has been deleted.', 'success')
                    return
                }

                Swal.fire('Error!', data.error, 'error')
            })
        })
    })
})

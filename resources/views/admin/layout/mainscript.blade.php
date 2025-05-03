<script>
    $(function() {
        // $("#jsGrid1").jsGrid({
        //     height: "100%",
        //     width: "100%",

        //     sorting: true,
        //     paging: true,

        //     data: db.clients,

        //     fields: [{
        //             name: "Name",
        //             type: "text",
        //             width: 150
        //         },
        //         {
        //             name: "Age",
        //             type: "number",
        //             width: 50
        //         },
        //         {
        //             name: "Address",
        //             type: "text",
        //             width: 200
        //         },
        //         {
        //             name: "Country",
        //             type: "select",
        //             items: db.countries,
        //             valueField: "Id",
        //             textField: "Name"
        //         },
        //         {
        //             name: "Married",
        //             type: "checkbox",
        //             title: "Is Married"
        //         }
        //     ]
        // });
    });


    // $(function() {
    //     $("#example1").DataTable({
    //         "responsive": true,
    //         "lengthChange": false,
    //         "autoWidth": false,
    //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    //     $('#example2').DataTable({
    //         "paging": true,
    //         "lengthChange": false,
    //         "searching": false,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "responsive": true,
    //     });
    // });


    // $(function () {
    // $.validator.setDefaults({
    //   submitHandler: function () {
    //     alert( "Form successful submitted!" );
    //   }
    // });

    // $('#quickForm').validate({
    //     rules: {
    //         email: {
    //             required: true,
    //             email: true,
    //         },
    //         password: {
    //             required: true,
    //             minlength: 5
    //         },
    //         terms: {
    //             required: true
    //         },
    //     },
    //     messages: {
    //         email: {
    //             required: "Please enter a email address",
    //             email: "Please enter a valid email address"
    //         },
    //         password: {
    //             required: "Please provide a password",
    //             minlength: "Your password must be at least 5 characters long"
    //         },
    //         terms: "Please accept our terms"
    //     },
    //     errorElement: 'span',
    //     errorPlacement: function(error, element) {
    //         error.addClass('invalid-feedback');
    //         element.closest('.form-group').append(error);
    //     },
    //     highlight: function(element, errorClass, validClass) {
    //         $(element).addClass('is-invalid');
    //     },
    //     unhighlight: function(element, errorClass, validClass) {
    //         $(element).removeClass('is-invalid');
    //     }
    // });


    //product aattribute add delete

    // blog image preview

    function previewBolgImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewImage');
            output.src = reader.result;
            output.classList.remove('d-none');
            var currentImage = document.getElementById('currentImage');
            if (currentImage) {
                currentImage.classList.add('d-none');
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }


    //ckeditor for blog
    // CKEDITOR.replace('blogContentHtml');
</script>

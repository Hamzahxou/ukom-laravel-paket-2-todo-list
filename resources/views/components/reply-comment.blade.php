<script>
    function replyComment(url) {
        // Membuka SweetAlert untuk memperbarui komentar
        const swalWithTailwindButtons = Swal.mixin({
            customClass: {
                confirmButton: "flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mx-5",
                cancelButton: "flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mx-2"
            },
            buttonsStyling: false
        });

        swalWithTailwindButtons.fire({
            title: "Reply Comment",
            html: `
                <textarea id="swal-input1" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min-h-40" placeholder="Comment..." rows="30" style="field-sizing: content;max-height: 200px"></textarea>
            `,
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
                return document.getElementById("swal-input1").value;
            }
        }).then((result) => {
            if (result.value) {
                // Membuat form sederhana dengan metode POST
                const form = document.createElement("form");
                form.method = "POST"; // Tetap menggunakan POST karena HTML hanya mendukung POST secara langsung

                // Menambahkan input CSRF Token
                const csrfToken = document.createElement("input");
                csrfToken.type = "hidden";
                csrfToken.name = "_token";
                csrfToken.value = "{{ csrf_token() }}"; // Pastikan CSRF token disertakan
                form.appendChild(csrfToken);

                // Menambahkan input untuk content yang diupdate
                const contentField = document.createElement("input");
                contentField.type = "hidden";
                contentField.name = "content"; // Nama yang sesuai dengan input di controller
                contentField.value = result.value;
                form.appendChild(contentField);

                // Set action URL ke URL yang diberikan
                form.action = url;

                // Tambahkan form ke body dan kirimkan
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

<form class="user-regis-form form-hidden mt-4" data-form="user">

    <input type="text" class="form-control input-login" name="namaUser" placeholder="Masukkan Nama Anda...">
    <input type="email" class="form-control input-login" name="emailUser" placeholder="Masukkan Email Anda...">

    <div class="password-input">
        <input type="password" name="passUser" id="passwordRegis" class="form-control input-login" placeholder="Masukkan Password...">
        <i class="fa-regular fa-eye-slash toggle-password"></i>
    </div>

    <div class="password-input">
        <input type="password" id="passwordRepeat" name="passUserRepeat" class="form-control input-login" placeholder="Masukkan Ulang Password...">
        <i class="fa-regular fa-eye-slash toggle-password"></i>
    </div>

    <button type="submit" class="btn btn-login w-100" id="btnRegister">
        <span class="btn-text">Daftar</span>
        <span class="btn-loading d-none">
            <span class="spinner-border spinner-border-sm"></span>
            Loading...
        </span>
    </button>


    <p class="fw-light mt-3 text-center">Sudah Punya Akun? <a href="" class="text-decoration-none text-danger fw-semibold ">Login</a></p>
</form>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const form = document.querySelector('.user-regis-form');
    const btn = document.getElementById('btnRegister');
    const btnText = btn.querySelector('.btn-text');
    const btnLoading = btn.querySelector('.btn-loading');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // 🔒 disable button + loading
        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        const formData = new FormData(form);

        axios.post('/login/request-otp', formData)
            .then(res => {
                Swal.fire({
                    title: "Verifikasi OTP",
                    text: "Kode OTP telah dikirimkan ke email Anda",
                    input: "text",
                    inputPlaceholder: "Masukkan Kode OTP Disini",
                    showCancelButton: true,
                    confirmButtonText: "Verifikasi",
                    cancelButtonText: "Batal",
                    preConfirm: (otp) => {
                        formData.append('otp', otp);
                        return axios.post('/login/verify-otp', formData)
                        .then(res => {
                            if (res.data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registrasi Berhasil',
                                    text: 'Silahkan login untuk melanjutkan.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = res.data.redirect;
                                });
                            }
                        })
                        .catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Verifikasi Gagal',
                                text: err.response.data.message,
                                confirmButtonText: 'OK'
                            });
                        });
                    }
                })
            })
            .catch(err => {
                let message = 'Terjadi kesalahan';

                if (err.response?.status === 422) {
                    const errors = err.response.data.errors;
                    message = Object.values(errors)[0][0];
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Pendaftaran Gagal',
                    text: message,
                });
            })
            .finally(() => {
                // 🔓 aktifkan kembali button
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoading.classList.add('d-none');
            });
    });
</script>


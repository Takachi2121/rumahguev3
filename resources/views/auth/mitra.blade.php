<form class="worker-regis-form form-hidden mt-4" data-form="mitra">

    <input type="text" class="form-control input-login" placeholder="Masukkan Nama Anda...">
    <input type="text" class="form-control input-login" placeholder="Masukkan Alamat Anda...">
    <select class="form-control input-login">
        <option selected class="d-none">Pilih Keahlian Anda...</option>
        <option>Desainer Interior</option>
        <option>Arsitek</option>
        <option>Konstruksi</option>
        <option>Tukang</option>
    </select>
    <input type="text" class="form-control input-login" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/[^\d]/g, '')" placeholder="Masukkan No. Whatsapp Anda...">
    <input type="email" class="form-control input-login" placeholder="Masukkan Email Anda...">

    <div class="password-input">
        <input type="password" id="password" class="form-control input-login" placeholder="Masukkan Password...">
        <i class="fa-regular fa-eye toggle-password"></i>
    </div>

    <div class="password-input">
        <input type="password" id="passwordRepeat" class="form-control input-login" placeholder="Masukkan Ulang Password...">
        <i class="fa-regular fa-eye toggle-password"></i>
    </div>

    <button type="submit" class="btn btn-login w-100">Daftar</button>

    <p class="fw-light mt-3 text-center">Sudah Punya Akun? <a href="" class="text-decoration-none text-danger fw-semibold ">Login</a></p>
</form>

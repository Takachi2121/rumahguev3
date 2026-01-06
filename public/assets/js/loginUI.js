const loginForm   = document.querySelector('.login-form');
const userForm    = document.querySelector('.user-regis-form');
const companyForm = document.querySelector('.company-regis-form');
const workerForm  = document.querySelector('.worker-regis-form');

const registerSwitch = document.querySelector('.register-switch');
const goRegister = document.getElementById('goRegister');

const switchBox   = document.getElementById('dynamicSwitch');
const indicator   = switchBox.querySelector('.auth-indicator');
const leftBtn     = switchBox.querySelector('[data-action="user"]');
const switchRight = document.getElementById('switchRight');

let state = 'main';        // main | mitra
let mitraType = 'company';

// ===== CREATE NESTED INDICATOR =====
let subIndicator = document.createElement('div');
subIndicator.classList.add('sub-indicator');
switchRight.appendChild(subIndicator);

// ===== HELPERS =====
function hideAllForms() {
    [loginForm, userForm, companyForm, workerForm]
        .forEach(f => f.classList.add('form-hidden'));
}

function showForm(form) {
    form.classList.remove('form-hidden');
    form.classList.remove('form-fade');
    void form.offsetWidth;
    form.classList.add('form-fade');
}

function setIndicator(x, w) {
    indicator.style.setProperty('--x-pos', x);
    indicator.style.setProperty('--x-width', w);
}

function setSubIndicator(x, w) {
    subIndicator.style.setProperty('--sub-x', x);
    subIndicator.style.setProperty('--sub-width', w);
}

// ===== REGISTER CLICK =====
goRegister.addEventListener('click', e => {
    e.preventDefault();
    loginForm.classList.add('d-none');
    registerSwitch.classList.remove('d-none');

    state = 'main';
    switchRight.innerHTML = `<button data-action="mitra" style="padding-left: 74px">Daftar sebagai Mitra</button>`;
    switchRight.appendChild(subIndicator);

    leftBtn.classList.add('active');
    setIndicator('0%', '33%');
    setSubIndicator('0%', '0%'); // hidden

    hideAllForms();
    showForm(userForm);
});

// ===== LEFT BUTTON (USER / BACK) =====
leftBtn.addEventListener('click', () => {
    // Reset ke awal
    state = 'main';
    switchRight.innerHTML = `<button data-action="mitra" style="padding-left: 74px">Daftar sebagai Mitra</button>`;
    switchRight.appendChild(subIndicator);

    leftBtn.classList.add('active');
    setIndicator('0%', '33%');
    setSubIndicator('0%', '0%'); // nested hilang

    hideAllForms();
    showForm(userForm);
});

// ===== RIGHT SIDE CLICK =====
switchRight.addEventListener('click', e => {
    const btn = e.target.closest('button');
    if (!btn) return;

    // MASUK MODE MITRA
    if (btn.dataset.action === 'mitra') {
        state = 'mitra';
        mitraType = 'company';

        switchRight.innerHTML = `
            <button data-mitra="company" class="active">Perusahaan</button>
            <button data-mitra="worker">Tukang</button>
        `;
        switchRight.appendChild(subIndicator);

        leftBtn.classList.remove('active');

        setIndicator('50%', '65.6%'); // hitam meluas ke area Mitra
        setSubIndicator('5%', '46%'); // nested putih Perusahaan

        hideAllForms();
        showForm(companyForm);

        // warna teks nested putih
        switchRight.querySelectorAll('button').forEach(b => b.classList.contains('active') ? b.style.color = 'black' : b.style.color = 'white');

        return;
    }

    // TOGGLE PERUSAHAAN / TUKANG
    if (btn.dataset.mitra) {
        mitraType = btn.dataset.mitra;

        switchRight.querySelectorAll('button').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        setSubIndicator(
            mitraType === 'company' ? '5%' : '116%',
            mitraType === 'company' ? '46%' : '45%'
        );

        hideAllForms();
        mitraType === 'company'
            ? showForm(companyForm)
            : showForm(workerForm);

        // nested teks selalu hitam
        switchRight.querySelectorAll('button').forEach(b => b.classList.contains('active') ? b.style.color = 'black' : b.style.color = 'white');
    }
});

const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function () {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';

    this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});

document.addEventListener("click", function (e) {

    // PASSWORD UTAMA
    if (e.target.classList.contains("togglePasswordRegis")) {
        const wrapper = e.target.closest(".password-input");
        const input = wrapper.querySelector("input");

        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";

        e.target.classList.toggle("fa-eye");
        e.target.classList.toggle("fa-eye-slash");
    }

    // PASSWORD ULANG
    if (e.target.classList.contains("togglePasswordRepeat")) {
        const wrapper = e.target.closest(".password-input");
        const input = wrapper.querySelector("input");

        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";

        e.target.classList.toggle("fa-eye");
        e.target.classList.toggle("fa-eye-slash");
    }
});

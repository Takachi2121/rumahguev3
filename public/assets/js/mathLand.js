document.addEventListener("DOMContentLoaded", function() {
    const categoryBtns = document.querySelectorAll('.category__btn');

    let selectedCategory = 'Minimalis';

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(catBtn => {
                catBtn.classList.remove('category__active');
            });
            this.classList.add('category__active');
            selectedCategory = btn.textContent;
        });
    });
});

let data = {
    gsb: 2,
    konsep: 0,
    panjang: 0,
    lebar: 0,
    hook: false,
    lantai: 1,
    luasTotal: 0,
    luas: 0,
    fasad: 0,
    totalHarga: 0,
    carpot: true,
    sisa: 0,
    ready: true,
    auto: true,
};

let rab = {
    data: [],
    luas: 0,
    konsep: 0,
    total: 0,
    lantai: 1,
};


document.addEventListener('DOMContentLoaded', function() {
    const simulasiText = document.querySelector('.simulasi span');
    const simulasiButton = document.querySelector('.simulasi');
    const simulasiImage = document.querySelector('.simulasi img');
    const panjangInput = document.getElementById('panjang-tanah');
    const lebarInput = document.getElementById('inputLebar');

    if(lebarInput.value == 0 && panjangInput.value == 0) {
        simulasiText.innerText = 'Mohon isi panjang dan lebar tanah';
        simulasiButton.disabled = true;
        simulasiImage.style.width = '34.43px';
        simulasiImage.style.height = '30.82px';
        simulasiImage.src = 'assets/images/shape/Info.png';
        simulasiButton.style.background = '#343A40';
        simulasiButton.style.border = '3px solid #343A40';
    }

    document.getElementById('label-luas').innerHTML = parseInt(data.luas) >= 47
        ? `- ${data.luas * 2} m<sup>2</sup>`
        : `- ${data.luas} m<sup>2</sup>`;


    buttonActive = document.querySelector('.category__active');
    data.konsep = parseInt(buttonActive.getAttribute('ind'));

    let spanLantai = document.querySelector('#lantai-rumah');
    let isiLantai = spanLantai.textContent.trim();

    if (isiLantai.includes('Lantai 1')) {
        spanLantai.classList.add('lt1');
        spanLantai.classList.remove('lt2');
    } else if (isiLantai.includes('Lantai 2')) {
        spanLantai.classList.add('lt2');
        spanLantai.classList.remove('lt1');
    }
});

let debounceTimeout = null;

function onInputChange() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        rthCheck();
    }, 400); // tunggu 400ms setelah user berhenti ngetik
}

function rthCheck() {
    data.sisa = ((data.panjang * data.lebar) - data.luas);
    if (data.sisa < 17.5) {
        if ((data.luas - (17.5 - data.sisa)) > 36) {
            data.luas = data.luas - (17.5 - data.sisa);
            data.sisa = 17.5;
            data.carpot = true;
        } else {
            data.carpot = false;
        }
    } else {
        data.carpot = true;
    }

    const sisa = data.sisa - 17.5;
    document.getElementById('l-tanah').value = (data.panjang * data.lebar).toFixed(2);
    document.getElementById('l-bangunan').value = data.luas.toFixed(2);
    document.getElementById('l-rth').value = sisa > 0 ? sisa : 0;
    document.getElementById('l-carpot').value = 17.5;

    const simulasiText = document.querySelector('.simulasi span');
    const simulasiButton = document.querySelector('.simulasi');
    const simulasiImage = document.querySelector('.simulasi img');
    const panjangInput = document.getElementById('panjang-tanah');
    const lebarInput = document.getElementById('inputLebar');

    if(parseInt(document.getElementById('l-bangunan').value) >= 47 && data.lantai === 1) {
        document.getElementById('lantai-naik').click();
    }else{
        document.getElementById('lantai-turun').click();
    }

    const isLoggedIn = document.querySelector('meta[name="logged-in"]').getAttribute('content');

    if ((panjangInput.value > 0 && lebarInput.value > 0) && parseInt(data.luas) < 36) {
        simulasiText.innerText = 'Maaf Luas Tanah Anda Kurang Dari Yang Kami Rekomendasikan';
        simulasiButton.disabled = true;
        simulasiImage.src = 'assets/images/shape/cancel.png';
        simulasiImage.style.width = '34.43px';
        simulasiImage.style.height = '30.82px';
        simulasiButton.style.background = '#da1c1f';
        simulasiButton.style.border = '3px solid #da1c1f';
    } else {
        simulasiText.innerText = 'Simulasikan RAB Anda';
        simulasiButton.disabled = false;
        simulasiImage.style.width = '45.43px';
        simulasiImage.style.height = '35.82px';
        simulasiImage.src = 'assets/images/shape/Simulasi.png';
        simulasiButton.style.background = 'radial-gradient(circle, #FFAE2C 0%, #FEA500 32%, #ED7000 100%)';
        simulasiButton.style.border = '3px solid #FFAE2C';
    }
}

function showPop(id) {
    const elem = document.getElementById(id);
    elem.style.display = elem.style.display === 'none' ? 'flex' : 'none';
}

function lantaiChange(elem, lt) {
    if (data.luas < 47 && lt === 2) return;

    data.lantai = lt;
    rab.lantai = lt;

    const lt1 = document.getElementById('lantai-turun');
    const lt2 = document.getElementById('lantai-naik');
    const lantaiImg = document.getElementById('lantai');
    const spanLantai = document.getElementById('lantai-rumah');

    lt1.classList.remove('active');
    lt2.classList.remove('active');
    elem.classList.add('active');

    if (lt === 2 ) {
        lantaiImg.src = 'assets/images/resource/Lantai-02.svg';
        spanLantai.innerHTML = 'Lantai 2 <label id="label-luas-2"></label>';
    } else {
        lantaiImg.src = 'assets/images/resource/Lantai-01.svg';
        spanLantai.innerHTML = 'Lantai 1 <label id="label-luas-1"></label>';
    }

    const label = document.getElementById(lt === 2 ? 'label-luas-2' : 'label-luas-1');
    label.innerHTML = data.luas >= 47 && lt === 2
        ? `- ${data.luas * 2} m<sup>2</sup>`
        : `- ${data.luas} m<sup>2</sup>`;
}


function hook(elem, hook) {
    data.hook = hook;

    const hk1 = document.getElementById('hook-1');
    const hk2 = document.getElementById('hook-2');

    hk1.classList.remove('active');
    hk2.classList.remove('active');
    elem.classList.add('active');

    if (data.panjang > 0 && data.lebar > 0) {
        data.luas = data.hook
            ? (data.panjang - data.gsb) * (data.lebar - data.gsb)
            : (data.panjang - data.gsb) * data.lebar;

        rthCheck();
    }
}

function choose(elem, d) {
    for (let i = 0; i < 10; i++) {
        const el = document.getElementById(`konsep-${i}`);
        if (el) {
            el.classList.remove('category__active');
            el.children[0]?.style?.removeProperty('filter');
        }
    }
    elem.classList.add('category__active');
    elem.children[0]?.style?.setProperty('filter', 'brightness(1)');
    data.konsep = parseInt(elem.getAttribute('ind'));
}

function IsLoggedIn(){
    Swal.fire({
        text: 'Silahkan Login Terlebih Dahulu',
        icon: 'info',
        confirmButtonText: 'Pergi ke Halaman Login',
    }).then((result) => {
        if(result.isConfirmed){
            window.location.href = '/login';
        }
    })
}

function getRABDataFromDOM(){
    const rows = document.querySelectorAll('#table-rab tbody tr');
    let data = [];

    rows.forEach((row, index) => {
        const cells = row.querySelectorAll('td');
        if(cells.length >= 4){

            let volume = '';
            let unit = '';
            const divElement = cells[2].querySelector('div');
            const inputElement = cells[2].querySelector('input');
            const satuanElement = cells[2].querySelector('.satuan');

            if (inputElement) {
                volume = inputElement.value.trim();
            } else if (divElement) {
                volume = divElement.innerText.trim();
            } else {
                volume = '';
            }

            if (satuanElement) {
                unit = satuanElement.innerHTML.trim();
            }

            const volumeWithUnit = unit ? `${volume} ${unit}` : volume;

            data.push({
                no: index + 1,
                pekerjaan: cells[1].innerText.trim(),
                volume: volumeWithUnit,
                jumlah_harga: parseInt(cells[3].innerText.replace(/[^\d]/g, ''), 10) || 0
            });
        }
    });

    const konsep = parseInt(document.getElementById('konsep-biaya').innerText.replace(/[^\d]/g, ''), 10) || 0;
    const total = parseInt(document.getElementById('tot-biaya').innerText.replace(/[^\d]/g, ''), 10) || 0;

    data.push({
        konsep_biaya: konsep,
        total_biaya: total
    });

    return data;
}


function printRAB() {
    const rabData = getRABDataFromDOM();
    const csrf = document.querySelector("meta[name='csrf-token']").content;

    fetch('/preview-rab', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({
            rab: rabData
        })
    })
    .then(res => res.text())
    .then(html => {
        const iframe = document.createElement('iframe');
        iframe.style.position = 'fixed';
        iframe.style.right = '0';
        iframe.style.bottom = '0';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = '0';
        document.body.appendChild(iframe);

        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write(html);
        doc.close();

        iframe.onload = function () {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();

            setTimeout(() => {
                document.body.removeChild(iframe);
            }, 1000);
        };
    })
}


function order() {
    window.open('/formRequest/choose/rumah', '_blank');
}

function upTotal(val) {
    const plus = parseInt(data.totalHarga) + parseInt(val);
    const min = parseInt(data.totalHarga) - parseInt(val);
    const dif = plus - min;
    const bag = dif / val;
    return plus - bag;
}

function fillData(elem, selector) {
    let val = parseInt(elem.value);
    if (val > 2) {
        if (val > 30) elem.value = 30;

        function allowOnlyNumbers(event) {
            const char = String.fromCharCode(event.which);
            if (!/^\d$/.test(char)) {
                event.preventDefault();
            }
        }

        document.getElementById('panjang-tanah').addEventListener('keypress', allowOnlyNumbers);
        document.getElementById('inputLebar').addEventListener('keypress', allowOnlyNumbers);

        switch (selector) {
            case 'panjang':
                data.panjang = val;
                if (data.auto && val < 36) {
                    data.lebar = parseInt(((36 / (val - 2)) + (data.hook ? 2 : 0)).toFixed(0));
                    document.getElementById('inputLebar').value = data.lebar;
                }
                break;
            case 'lebar':
                data.lebar = val;
                data.auto = false;
                break;
        }

        data.luas = data.hook
            ? (data.panjang - data.gsb) * (data.lebar - data.gsb)
            : (data.panjang - data.gsb) * data.lebar;

        rthCheck();
    }
}

function changeValue(elem, disb) {
    const tot = document.getElementById('tot-biaya');
    const val = JSON.parse(elem.value);
    const box = document.getElementById(`input-${elem.getAttribute('subId')}`);
    const res = document.getElementById(`result-${elem.getAttribute('subId')}`);
    const curr = res.innerText.replace('Rp. ', '').split('.').join('');
    const ind = rab.data.findIndex(x => parseWhiteSpace(x.title) === elem.getAttribute('par'));

    if (Boolean(disb)) {
        box.value = (parseFloat(val.rasio) * data.luasTotal).toFixed(2);
    } else {
        box.innerHTML = (parseFloat(val.rasio) * data.luasTotal).toFixed(0);
    }

    data.totalHarga = (parseInt(data.totalHarga) - parseInt(curr)) + (parseFloat(box.value) * parseInt(val.harga));
    rab.data[ind].data[elem.getAttribute('ind')][0] = val.nama;
    rab.data[ind].data[elem.getAttribute('ind')][3] = (parseFloat(box.value) * parseInt(val.harga)).toFixed(0);
    rab.total = data.totalHarga + parseInt(data.fasad);

    res.innerHTML = formatRupiah((parseFloat(box.value) * parseInt(val.harga)).toFixed(0));
    tot.innerHTML = formatRupiah(data.totalHarga + parseInt(data.fasad), 'Rp. ');
    console.log('disb:', disb);
    console.log('Selected value:', val);
    console.log('Current value of box:', box.value);
    console.log('Updated total:', data.totalHarga);
}

function changeVolume(elem) {
    const tot = document.getElementById('tot-biaya');
    const sele = document.getElementById(`select-${elem.getAttribute('subId')}`);
    const harga = sele ? JSON.parse(sele.value).harga : parseFloat(document.getElementById(`label-${elem.getAttribute('subId')}`).getAttribute('val'));
    const res = document.getElementById(`result-${elem.getAttribute('subId')}`);
    const curr = res.innerText.replace('Rp. ', '').split('.').join('');
    const rr = (parseInt(elem.value || 0) * parseInt(harga)).toFixed(0);
    const ind = rab.data.findIndex(x => parseWhiteSpace(x.title) === elem.getAttribute('par'));

    data.totalHarga = (parseInt(data.totalHarga) - parseInt(curr)) + parseInt(rr || 0);
    rab.data[ind].data[elem.getAttribute('ind')][1] = elem.value;
    rab.data[ind].data[elem.getAttribute('ind')][3] = rr || 0;

    rab.total = data.totalHarga + parseInt(data.fasad);

    res.innerHTML = formatRupiah(rr || 0);
    tot.innerHTML = formatRupiah(data.totalHarga + parseInt(data.fasad), 'Rp. ');
}

function getRecomend(){
    if(data.ready){
        data.ready = false
        data.totalHarga = 0
        let con = document.querySelector('#res-wrapper');
        let form = document.querySelector('#simulasi-form');
        let simulasiText = document.querySelector('.simulasi span');
        let simulasiButton = document.querySelector('.simulasi');
        let simulasiImage = document.querySelector('.simulasi img');
        let panjangInput = document.getElementById('panjang-tanah');
        let lebarInput = document.getElementById('inputLebar');

        let spanLantai = document.querySelector('#lantai-rumah');
        let isiLantai = spanLantai.textContent.trim();
        let lt1;
        let lt2;

        // Deteksi berdasarkan isi text
        if (isiLantai.includes('Lantai 1')) {
            lt1 = 1;
        } else if (isiLantai.includes('Lantai 2')) {
            lt2 = 2;
        }

        let tabl = document.querySelector('#popup-rab #table-content');
        tabl.innerHTML = '';
        // con.style.display = 'none';

        if ((panjangInput.value > 0 && lebarInput.value > 0) && parseInt(data.luas) < 36) {
            simulasiText.innerText = 'Maaf Luas Tanah Anda Kurang Dari Yang Kami Rekomendasikan';
            simulasiButton.disabled = true;
            simulasiImage.src = 'assets/images/shape/cancel.png';
            simulasiImage.style.width = '34.43px';
            simulasiImage.style.height = '30.82px';
            simulasiButton.style.background = '#da1c1f';
            simulasiButton.style.border = '3px solid #da1c1f';
        } else {
            simulasiText.innerText = 'Simulasikan RAB Anda';
            simulasiButton.disabled = false;
            simulasiImage.style.width = '45.43px';
            simulasiImage.style.height = '35.82px';
            simulasiImage.src = 'assets/images/shape/Simulasi.png';
            simulasiButton.style.background = 'radial-gradient(circle, #FFAE2C 0%, #FEA500 32%, #ED7000 100%)';
            simulasiButton.style.border = '3px solid #FFAE2C';

            function template(d) {
                return `
                    <tr>
                        <td>${d.no}</td>
                        <td><img src="${d.img}" style="object-fit:cover;width: 4vw;height: 4vw;"/></td>
                        <td style="text-align: start;">${d.label}</td>
                        <td>${d.count} Buah</td>
                        <td>${d.luas} m<sup>2</sup></td>
                    </tr>
                `;
            }

            function total(){
                document.querySelector('#tot-biaya').innerHTML = formatRupiah(parseInt(data.totalHarga)+parseInt(data.fasad),'Rp. ')
                document.querySelector('#konsep-biaya').innerHTML = formatRupiah(parseInt(data.fasad),'Rp. ')
                rab.total = parseInt(data.totalHarga)+parseInt(data.fasad)
                rab.konsep = parseInt(data.fasad)
            }

            function template_rab(i,d,p){
                let itm_opt = ''
                data.totalHarga = parseInt(data.totalHarga)+parseInt((d[1]*d[3]).toFixed(0));

                let usedNames = new Set(); // Untuk melacak nama yang sudah ditampilkan
                Object.entries(d[6]).forEach(() => {
                    if (!usedNames.has(d[6].nama)) {
                        itm_opt += `<option value='${[JSON.stringify(d[6])]}'>${d[6].nama}</option>`;
                        usedNames.add(d[6].nama);
                    }
                });

                let t = `
                    <tr id="row-material-${i}" class="item-row">
                        <td style="text-align: center;">
                        ${i+1}.
                        </td>
                        <td style="text-align: start;">
                            ${d[6] ? `
                                <select style="width:100%;" id="select-${parseWhiteSpace(d[0])}" par="${parseWhiteSpace(p)}" ind="${i}" subId="${parseWhiteSpace(d[0])}" onchange="changeValue(this,${d[4]})">
                                    ${itm_opt}
                                </select>` : `
                                <span id="label-${parseWhiteSpace(d[0])}" val="${d[3]}">
                                    ${d[0]}
                                </span>`
                            }
                        </td>
                        <td style="text-align: right;display:flex;">
                            ${d[4] ?
                                `<div class="data-input" id="input-${parseWhiteSpace(d[0])}" style="width: 75%;">${d[1].toFixed(2)}</div>` :
                                `<input ${d[6] ? `id="input-${d[0]}"` : ''} type="number" min="0" value="${d[1].toFixed(0)}" ind="${i}" par="${parseWhiteSpace(p)}" oninput="changeVolume(this)" subId="${parseWhiteSpace(d[0])}" dir="rtl" style="width: 75%;text-align: right;"}/>
                            `}
                            <div class="satuan" style="
                                justify-content: center;
                                align-items: center;
                                flex:1;
                                display: flex;">${d[2]}</div>
                        </td>
                        <td id="result-${parseWhiteSpace(d[0])}" style="text-align: right;">
                            ${ formatRupiah( (d[1]*d[3]).toFixed(0) )}
                        </td>
                    </tr>`

                return t
            }

            function labelLantai1(){
                return `
                    <td colspan="5" style="text-align: center;">Lantai 1</td></td>
                `
            }
            function labelLantai2(){
                return `
                    <td colspan="5" style="text-align: center;">Lantai 2</td></td>
                `
            }

            axios.post('/getRecommend', data)
                .then(response => {
                    let res = response.data;

                    if (res.ruang_1) {
                        axios.post('/getRab', {
                            luas: res.luas_1,
                            luasTotal: parseFloat(res.luas_1) + (res.luas_2 ? parseFloat(res.luas_2) : 0),
                            konsep: data.konsep,
                            lantai: data.lantai,
                            luas2: res.luas_2,
                            carpot: data.carpot,
                        })
                        .then(rr => {
                            let res2 = JSON.parse(rr.data);

                            data.luasTotal = parseFloat(res.luas_1) + (res.luas_2 ? parseFloat(res.luas_2) : 0);
                            data.fasad = res2.fasad;
                            rab.luas = data.luasTotal;

                            Object.entries(res2.lantai1).forEach((s) => {
                                rab.data.push({
                                    title: s[0],
                                    'data': []
                                });

                                tabl.insertAdjacentHTML('beforeEnd', `
                                    <tr style="padding: 1vh 0; background-color: lightgrey;">
                                        <td style="text-align:center;" colspan="4">
                                            <strong>${s[0]}</strong>
                                        </td>
                                    </tr>`);

                                s[1].forEach((ss, i) => {
                                    // console.log(ss[6]);
                                    if (ss[6] && Array.isArray(ss[6]) && ss[6][0] && ss[6][0].nama) {
                                        rab.data[rab.data.length - 1].data.push([
                                            ss[6].nama, // Sekarang aman untuk mengakses ss[6][0].nama
                                            `${ss[1].toFixed(2)}`,
                                            `${ss[2]}`,
                                            (ss[1] * ss[3]).toFixed(0),
                                            ss[6],
                                            ss[3]
                                        ]);
                                    } else {
                                        rab.data[rab.data.length - 1].data.push([
                                            ss[0],
                                            `${ss[1].toFixed(2)}`,
                                            `${ss[2]}`,
                                            (ss[1] * ss[3]).toFixed(0),
                                            ss[6],
                                            ss[3]
                                        ]);
                                    }
                                    tabl.insertAdjacentHTML('beforeEnd', template_rab(i, ss, s[0]));
                                });
                            });

                            total();
                            document.querySelector('#btm-form').style.visibility = 'visible';
                        })
                        .catch(error => {
                            console.error("There was an error fetching the RAB data: ", error);
                        });

                    if(isiLantai.includes('Lantai 1')){
                        lt1 = true;
                    }else{
                        lt1 = true;
                        lt2 = true;
                    }
                    if (lt1) {
                        const htmlRecommend = document.querySelector('#table-content');
                        htmlRecommend.insertAdjacentHTML('beforeend', labelLantai1());
                        res.ruang_1.forEach((s) => {
                            htmlRecommend.insertAdjacentHTML('beforeEnd', template({
                                no: res.ruang_1.indexOf(s) + 1,
                                label: s.nama,
                                count: s.jml,
                                luas: parseFloat(s.luas).toFixed(2),
                                img: s.img,
                            }));
                        });

                        if (res.ruang_2) {
                            const trs = document.querySelectorAll('#table-content tr');
                            const jemuranRow = Array.from(trs).find(el => el.textContent.includes('Ruang Cuci Jemuran'));
                            if (jemuranRow) {
                                jemuranRow.style.display = 'none';
                            }
                        }

                        document.querySelector('#popup-recommend').style.display = 'flex';
                        document.querySelector('.main-header').style.zIndex = 10;
                    }

                    con.style.display = 'block';
                    form.scrollTop = con.offsetTop;

                    if (res.ruang_2) {
                        if (lt2) {
                            const htmlRecommend = document.querySelector('#table-content');
                            htmlRecommend.insertAdjacentHTML('beforeEnd', labelLantai2());
                            res.ruang_2.forEach((s) => {
                                htmlRecommend.insertAdjacentHTML('beforeEnd', template({
                                    no: res.ruang_2.indexOf(s) + 1,
                                    label: s.nama,
                                    count: s.jml,
                                    luas: parseFloat(s.luas).toFixed(2),
                                    img: s.img,
                                }));
                            });
                            document.querySelector('#popup-recommend').style.display = 'flex';
                            document.querySelector('.main-header').style.zIndex = 10;
                        }
                    }

                    data.ready = true;
                }
            })
            .catch(error => {
                console.error("There was an error fetching the recommendation data: ", error);
            });
        }
    }
}

function parseWhiteSpace(val) {
    return val.split(' ').join('').toLowerCase();
}

function formatRupiah(angka, prefix = 'Rp. ') {
    let number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        rupiah += sisa ? '.' : '';
        rupiah += ribuan.join('.');
    }

    return prefix + rupiah;
}


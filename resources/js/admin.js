// resources/js/admin.js

window.openModalNeed = function (modalId, mode, data = null) {
    const modal = document.getElementById(modalId);
    const form = document.getElementById("formNeed");
    const title = document.getElementById("modalTitle");
    const methodInput = document.getElementById("formMethod");
    const divTerkumpul = document.getElementById("divTerkumpul");

    if (!modal) return;
    modal.classList.remove("hidden");

    if (mode === "edit" && data) {
        title.innerText = "Edit Kebutuhan";
        form.action = `/admin/needs/${data.id}`; // URL Manual
        methodInput.value = "PUT";
        divTerkumpul.classList.remove("hidden");

        if (document.getElementById("nama_barang"))
            document.getElementById("nama_barang").value = data.nama_barang;
        if (document.getElementById("target_jumlah"))
            document.getElementById("target_jumlah").value = data.target_jumlah;
        if (document.getElementById("satuan"))
            document.getElementById("satuan").value = data.satuan;
        if (document.getElementById("jumlah_terkumpul_input"))
            document.getElementById("jumlah_terkumpul_input").value =
                data.jumlah_terkumpul;
    } else {
        title.innerText = "Tambah Kebutuhan";
        form.action = "/admin/needs"; // URL Manual untuk store
        methodInput.value = "POST";
        divTerkumpul.classList.add("hidden");
        form.reset();
    }
};

window.closeModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add("hidden");
};

// Gunakan addEventListener agar tidak bentrok dengan script lain
window.addEventListener("click", function (event) {
    const modal = document.getElementById("modalNeed");
    if (event.target == modal) {
        window.closeModal("modalNeed");
    }
});

// Fungsi untuk membuka modal Program (Tambah & Edit)
window.openModalProgram = function (modalId, mode, data = null) {
    const modal = document.getElementById(modalId);
    const form = document.getElementById("formProgram");
    const title = document.getElementById("modalTitleProgram");
    const methodInput = document.getElementById("formMethodProgram");

    // Elemen Preview Gambar
    const imgPreview = document.getElementById("img-preview");
    const placeholder = document.getElementById("image-placeholder");
    const existingInfo = document.getElementById("existing-img-info");

    if (!modal) return;

    // Tampilkan Modal
    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden"; // Kunci scroll background

    if (mode === "edit" && data) {
        // --- MODE EDIT ---
        title.innerText = "Edit Program";
        form.action = `/admin/programs/${data.id}`;
        methodInput.value = "PUT";

        // Isi Field Form
        document.getElementById("field_nama_program").value = data.nama_program;
        document.getElementById("field_deskripsi").value = data.deskripsi;
        document.getElementById("field_tanggal_mulai").value =
            data.tanggal_mulai;
        document.getElementById("field_tanggal_selesai").value =
            data.tanggal_selesai;

        // Tampilkan Preview Gambar Jika Ada
        if (data.gambar) {
            imgPreview.src = `/storage/${data.gambar}`;
            imgPreview.classList.remove("hidden");
            placeholder.classList.add("hidden");
            existingInfo.classList.remove("hidden");
        }
    } else {
        // --- MODE TAMBAH ---
        title.innerText = "Tambah Program";
        form.action = "/admin/programs";
        methodInput.value = "POST";
        form.reset();

        // Reset Preview Gambar
        imgPreview.classList.add("hidden");
        placeholder.classList.remove("hidden");
        existingInfo.classList.add("hidden");
    }
};

// Fungsi Tutup Modal
window.closeModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto"; // Aktifkan kembali scroll
    }
};

// Logika Preview Gambar saat pilih file
document.addEventListener("change", function (e) {
    if (e.target && e.target.id === "field_gambar") {
        const file = e.target.files[0];
        const preview = document.getElementById("img-preview");
        const placeholder = document.getElementById("image-placeholder");

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
                placeholder.classList.add("hidden");
            };
            reader.readAsDataURL(file);
        }
    }
});

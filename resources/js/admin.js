window.closeModal = function (id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.add("hidden");
};

window.openModalNeed = function (id, mode, data = null) {
    const modal = document.getElementById(id);
    const form = document.getElementById("formNeed");
    const method = document.getElementById("formMethod");
    const title = document.getElementById("modalTitle");
    const divTerkumpul = document.getElementById("divTerkumpul");

    if (mode === "edit") {
        title.innerText = "Edit Kebutuhan";
        form.action = "/admin/needs/" + data.id;
        method.value = "PUT";

        document.getElementById("nama_barang").value = data.nama_barang;
        document.getElementById("target_jumlah").value = data.target_jumlah;
        document.getElementById("satuan").value = data.satuan;

        divTerkumpul.classList.remove("hidden");
        document.getElementById("jumlah_terkumpul").value =
            data.jumlah_terkumpul;
    } else {
        title.innerText = "Tambah Kebutuhan";
        form.action = "/admin/needs";
        method.value = "POST";

        divTerkumpul.classList.add("hidden");
        document.getElementById("jumlah_terkumpul").value = 0;
        form.reset();
    }
    modal.classList.remove("hidden");
};

window.openModalProgram = function (id, mode, data = null) {
    const modal = document.getElementById(id);
    const form = document.getElementById("formProgram");
    const method = document.getElementById("formMethod");
    const title = document.getElementById("modalTitle");

    if (mode === "edit") {
        title.innerText = "Edit Program";
        form.action = "/admin/programs/" + data.id;
        method.value = "PUT";
        document.getElementById("nama_program").value = data.nama_program;
        document.getElementById("deskripsi").value = data.deskripsi;
        document.getElementById("tanggal_mulai").value = data.tanggal_mulai;
        document.getElementById("tanggal_selesai").value = data.tanggal_selesai;
        document.getElementById("gambar").value = "";
    } else {
        title.innerText = "Tambah Program";
        form.action = "/admin/programs";
        method.value = "POST";
        form.reset();
    }

    // Tambahan: Pastikan pratinjau direset saat membuka modal tambah program
    const originalOpenModal = window.openModalProgram;
    window.openModalProgram = function (id, mode, data = null) {
        if (mode === "add") {
            document
                .getElementById("preview-container")
                .classList.add("hidden");
            document
                .getElementById("placeholder-content")
                .classList.remove("hidden");
            document.getElementById("gambar").value = ""; // Reset input file
        }
        // Jalankan fungsi modal asli jika ada
        if (originalOpenModal) originalOpenModal(id, mode, data);
    };
    modal.classList.remove("hidden");
};

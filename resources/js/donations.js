window.openModalDonasi = function (id) {
    document.getElementById(id).classList.remove("hidden");
};

window.closeModal = function (id) {
    document.getElementById(id).classList.add("hidden");
};

window.switchTabDonasi = function (mode) {
    const areaUang = document.getElementById("areaUang");
    const areaBarang = document.getElementById("areaBarang");
    const jenisInput = document.getElementById("jenis_donasi");
    const tabUangBtn = document.getElementById("tabUangBtn");
    const tabBarangBtn = document.getElementById("tabBarangBtn");

    const inputNominal = document.getElementById("inputNominal");
    const selectNeed = document.getElementById("selectNeed");
    const inputJumlah = document.getElementById("inputJumlah");

    if (mode === "barang") {
        areaUang.classList.add("hidden");
        areaBarang.classList.remove("hidden");
        jenisInput.value = "barang";

        // Update Style Tab
        tabBarangBtn.classList.add("border-green-500", "bg-green-50");
        tabUangBtn.classList.remove("border-orange-500", "bg-orange-50");

        // Toggle Required
        inputNominal.required = false;
        selectNeed.required = true;
        inputJumlah.required = true;
    } else {
        areaBarang.classList.add("hidden");
        areaUang.classList.remove("hidden");
        jenisInput.value = "uang";

        // Update Style Tab
        tabUangBtn.classList.add("border-orange-500", "bg-orange-50");
        tabBarangBtn.classList.remove("border-green-500", "bg-green-50");

        // Toggle Required
        inputNominal.required = true;
        selectNeed.required = false;
        inputJumlah.required = false;
    }
};

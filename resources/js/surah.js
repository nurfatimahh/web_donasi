document.addEventListener("DOMContentLoaded", () => {
    // Daftar ID yang mau dianimasikan
    const elements = [
        { id: "hero-title", delay: 100 },
        { id: "hero-heading", delay: 300 },
        { id: "hero-desc", delay: 500 },
        { id: "hero-btn-container", delay: 700 },
    ];

    elements.forEach((item) => {
        setTimeout(() => {
            const el = document.getElementById(item.id);
            if (el) {
                el.classList.remove("opacity-0", "translate-y-10");
                el.classList.add("opacity-100", "translate-y-0");
            }
        }, item.delay);
    });
});

(async function () {
    try {
        const surahNo = Math.floor(Math.random() * 114) + 1;
        const response = await fetch(
            `https://quran-api.santrikoding.com/api/surah/${surahNo}`
        );

        if (response.ok) {
            const data = await response.json();
            const randomAyat =
                data.ayat[Math.floor(Math.random() * data.ayat.length)];

            // 1. Isi konten teksnya dulu
            document.getElementById("ayah-arabic").innerText = randomAyat.ar;
            document.getElementById(
                "ayah-info"
            ).innerText = `${data.nama_latin} · Ayat ${randomAyat.nomor}`;
            document.getElementById(
                "ayah-translation"
            ).innerText = `“${randomAyat.idn}”`;

            // 2. Munculkan dengan sedikit delay biar transisinya kebaca browser
            const card = document.getElementById("quran-card");
            setTimeout(() => {
                card.classList.remove(
                    "opacity-0",
                    "translate-y-5",
                    "pointer-events-none"
                );
                card.classList.add("opacity-100", "translate-y-0");
            }, 50); // Jeda 50ms saja, hampir tidak terasa tapi bikin halus
        }
    } catch (error) {
        console.log("Quran API sedang tidak stabil.");
    }
})();

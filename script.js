document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const tujuan = document.getElementById('tujuan').value;
            const tanggal = document.getElementById('tanggal').value;

            if (tujuan && tanggal) {
                alert(`🔎 Mencari paket liburan ke ${tujuan} pada tanggal ${tanggal}...`);
            } else {
                alert('⚠️ Mohon lengkapi tujuan dan tanggal sebelum mencari.');
            }
        });
    }

    const detailButtons = document.querySelectorAll('.detailButton');
    detailButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const tourRow = event.target.closest('tr');

            const tourName = tourRow.cells[0].innerText;
            const tourPrice = tourRow.querySelector('strong').innerText;
            
            alert(`
Anda tertarik dengan paket:
✈️ Paket: ${tourName}
💰 Harga Promo: ${tourPrice}

Informasi lebih lanjut akan segera kami kirimkan!
            `);
        });
    });

    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                darkModeToggle.textContent = 'Light'; 
            } else {
                darkModeToggle.textContent = 'Dark'; 
            }
        });
    }
});
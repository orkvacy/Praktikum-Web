document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('customModal');
    const modalText = document.getElementById('modalText');
    const closeButton = document.querySelector('.closeButton');

    function showModal(message) {
        modalText.innerText = message;
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }


    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            closeModal();
        }
    });

    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const tujuan = document.getElementById('tujuan').value;
            const tanggal = document.getElementById('tanggal').value;

            if (tujuan && tanggal) {
                showModal(`🔎 Mencari paket liburan ke ${tujuan} pada tanggal ${tanggal}...`);
            } else {
                showModal('⚠️ Mohon lengkapi tujuan dan tanggal sebelum mencari.');
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
            
            const message = `Anda tertarik dengan paket:\n
✈️ Paket: ${tourName}
💰 Harga Promo: ${tourPrice}\n
Informasi lebih lanjut akan segera kami kirimkan!`;
            
            showModal(message);
        });
    });

    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeLabel = document.getElementById('darkModeLabel');
    const body = document.body;

    if (darkModeToggle && darkModeLabel) {
        darkModeToggle.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                darkModeLabel.textContent = 'Light'; 
            } else {
                darkModeLabel.textContent = 'Dark'; 
            }
        });
    }
});
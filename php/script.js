document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('customModal');
    const closeButton = document.querySelector('.closeButton');
    const modalText = document.getElementById('modalText');
    const popupLoginForm = document.getElementById('popupLoginForm');
    const popupError = document.getElementById('popupError');

    const isLoggedIn = document.body.dataset.isLoggedIn === 'true';

    function showModalMessage(message) {
        popupLoginForm.style.display = 'none';
        modalText.style.display = 'block'; 
        modalText.innerText = message;
        modal.style.display = 'block';
    }

    function showLoginPopup() {
        modalText.style.display = 'none';
        popupLoginForm.style.display = 'block';
        popupError.style.display = 'none';
        popupLoginForm.reset(); 
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

            if (isLoggedIn) {
                const tujuan = document.getElementById('tujuan').value;
                const tanggal = document.getElementById('tanggal').value;

                if (tujuan && tanggal) {
                    showModalMessage(`🔎 Mencari paket liburan ke ${tujuan} pada tanggal ${tanggal}...`);
                } else {
                    showModalMessage('⚠️ Mohon lengkapi tujuan dan tanggal sebelum mencari.');
                }
            } else {
                showLoginPopup();
            }
        });
    }
    
    if (popupLoginForm) {
        popupLoginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('popupUsername').value;
            const password = document.getElementById('popupPassword').value;

            // fetch ajax
            fetch('ajax_login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
            })
            .then(response => response.json()) 
            .then(data => {
                if (data.success) {
                    if (data.isAdmin) {
                        alert('Login sebagai admin berhasil! Anda akan diarahkan ke dashboard.');
                        window.location.href = 'dashboard.php'; 
                    } else {
                        alert('Login berhasil! Halaman akan dimuat ulang.');
                        location.reload(); 
                    }
                } else {
                    popupError.textContent = data.message;
                    popupError.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                popupError.textContent = 'Terjadi kesalahan pada koneksi. Silakan coba lagi.';
                popupError.style.display = 'block';
            });
        });
    }

    const detailButtons = document.querySelectorAll('.detailButton');
    detailButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const tourRow = event.target.closest('tr');
            const tourName = tourRow.cells[0].innerText;
            const tourPrice = tourRow.querySelector('strong').innerText;
            
            const message = `Anda tertarik dengan paket:\n\n✈️ Paket: ${tourName}\n💰 Harga Promo: ${tourPrice}\n\nInformasi lebih lanjut akan segera kami kirimkan!`;
            
            showModalMessage(message);
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
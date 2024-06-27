
document.getElementById('loginForm').addEventListener('submit', async (event) => {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, password })
        });

        const data = await response.json();

        if (response.ok) {
            window.location.href = 'home.php';
        } else {
            showAlert('Invalid username or password');
        }
    } catch (error) {
        showAlert('An error occurred. Please try again later.');
    }
});

function showAlert(message) {
    const alertContainer = document.getElementById('alertContainer');
    alertContainer.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
}

document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
    });
});

$(document).ready(function () {
    $.ajax({
        url: 'home.php',
        type: 'GET',
        success: function (data) {
            var response = JSON.parse(data);
            $('#user-count').text(response.user_count);
            $('#wisata-count').text(response.wisata_count);
            $('#kuliner-count').text(response.kuliner_count);

            // Buat grafik pemesanan
            if (response.pemesanan_counts.length > 0) {
                var ctx = document.getElementById('pemesanan-chart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: response.dates,
                        datasets: [{
                            label: 'Pemesanan',
                            data: response.pemesanan_counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            } else {
                $('#pemesanan-chart').hide();
                $('#chart-message').text('Belum terdapat data pemesanan');
            }
        }
    });
});

function loadWisata() {
    const wisataData = [
      {
        id_wisata: 1,
        nama_wisata: "Wisata A",
        deskripsi_wisata: "Deskripsi Wisata A",
        lokasi_wisata: "Lokasi A",
        harga_tiket: 50000,
        gambar: "wisata_a.jpg"
      },
      {
        id_wisata: 2,
        nama_wisata: "Wisata B",
        deskripsi_wisata: "Deskripsi Wisata B",
        lokasi_wisata: "Lokasi B",
        harga_tiket: 75000,
        gambar: null
      }
    ];
  
    const wisataContainer = document.getElementById("wisataContainer");
    wisataContainer.innerHTML = "";
  
    wisataData.forEach(wisata => {
      const card = document.createElement("div");
      card.classList.add("col-md-4", "mb-4");
  
      card.innerHTML = `
        <div class="card h-100">
          <div class="card-image">
            ${wisata.gambar ? `<img src="images/${wisata.gambar}" alt="${wisata.nama_wisata}">` : '<img src="images/default.jpg" alt="Gambar Tidak Tersedia">'}
          </div>
          <div class="card-body">
            <h5 class="card-title">${wisata.nama_wisata}</h5>
            <p class="card-text">${wisata.deskripsi_wisata}</p>
            <p>Lokasi: ${wisata.lokasi_wisata}</p>
            <p>Harga Tiket: Rp ${wisata.harga_tiket.toLocaleString()}</p>
            <div class="d-flex justify-content-end">
              <button class="btn btn-primary me-2">Edit</button>
              <button class="btn btn-danger">Hapus</button>
            </div>
          </div>
        </div>
      `;
  
      wisataContainer.appendChild(card);
    });
  }
  
  loadWisata();



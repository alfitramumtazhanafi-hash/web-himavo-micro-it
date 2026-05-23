<?php
require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM dokumentasi ORDER BY tanggal DESC");
$dokumentasi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dokumentasi - HIMAVO MICRO IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap");
        
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8fbff;
            color: #333;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(5px);
            padding: 15px 0;
        }
        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }
        .nav-link {
            color: #555 !important;
            font-weight: 500;
            font-size: 0.9rem;
            margin-left: 15px;
        }
        .nav-link.active {
            color: #2575fc !important;
            font-weight: 600;
        }
        .dokumentasi-page-container {
            padding-top: 140px;
            padding-bottom: 100px;
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0c1236;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        .section-title:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 2px;
        }
        .gallery-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            cursor: pointer;
        }
        .gallery-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 30px -12px rgba(0, 0, 0, 0.15);
        }
        .gallery-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }
        .gallery-caption {
            padding: 18px 20px;
        }
        .gallery-caption h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .gallery-caption p {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        .badge-kategori {
            background: #eef2ff;
            color: #2575fc;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 12px;
        }
        .admin-badge {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .btn-admin {
            background: #2575fc;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 0.85rem;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.3);
            text-decoration: none;
        }
        .btn-admin:hover {
            background: #1a5cd4;
            color: white;
        }
        .modal-img {
            width: 100%;
            border-radius: 12px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
    </style>
</head>
<body>

    <!-- navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.html">
                <img src="assets/Himavo-Micro-IT.png" alt="Logo Micro IT" 
                     onerror="this.src='https://micro-orm.ipb.ac.id/wp-content/uploads/2023/09/LOGO-HIMAVO-MICRO-IT.png'">
                <span class="fw-semibold text-dark fs-6">HIMAVO MICRO IT</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="kerja-sama.html">Kerja Sama</a></li>
                    <li class="nav-item"><a class="nav-link" href="partner.html">Partner</a></li>
                    <li class="nav-item"><a class="nav-link active" href="dokumentasi.php">Dokumentasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container dokumentasi-page-container">
        <div class="text-center mb-5 pb-3" data-aos="fade-up">
            <span class="text-kabinet" style="color: #2575fc; font-weight: 700; letter-spacing: 1px;">GALERI KEGIATAN</span>
            <h2 class="section-title">Dokumentasi MICRO IT</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                Momen kebersamaan, seminar, workshop, dan berbagai kegiatan seru himpunan mahasiswa teknologi.
            </p>
        </div>

        <!-- filter kategori -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" data-aos="fade-up">
            <button class="btn btn-sm rounded-pill px-3" style="background: #2575fc; color: white;">Semua</button>
            <button class="btn btn-sm rounded-pill px-3" style="background: #e9ecef; color: #495057;">Seminar</button>
            <button class="btn btn-sm rounded-pill px-3" style="background: #e9ecef; color: #495057;">Workshop</button>
            <button class="btn btn-sm rounded-pill px-3" style="background: #e9ecef; color: #495057;">Kebersamaan</button>
            <button class="btn btn-sm rounded-pill px-3" style="background: #e9ecef; color: #495057;">Kompetisi</button>
        </div>

        <!-- grid -->
        <div class="row g-4">
            <?php if (count($dokumentasi) > 0): ?>
                <?php foreach ($dokumentasi as $dok): ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="gallery-card" 
                         data-bs-toggle="modal" 
                         data-bs-target="#galleryModal"
                         data-img="uploads/<?php echo $dok['gambar']; ?>"
                         data-title="<?php echo htmlspecialchars($dok['judul']); ?>"
                         data-desc="<?php echo htmlspecialchars($dok['deskripsi']); ?>"
                         data-tanggal="<?php echo date('d F Y', strtotime($dok['tanggal'])); ?>"
                         data-lokasi="<?php echo htmlspecialchars($dok['lokasi']); ?>">
                        
                        <img src="uploads/<?php echo $dok['gambar']; ?>" 
                             class="gallery-img" 
                             onerror="this.src='https://via.placeholder.com/500x350?text=No+Image'"
                             alt="<?php echo htmlspecialchars($dok['judul']); ?>">
                        
                        <div class="gallery-caption">
                            <span class="badge-kategori"><?php echo $dok['kategori']; ?></span>
                            <h5><?php echo htmlspecialchars($dok['judul']); ?></h5>
                            <p><i class="far fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($dok['tanggal'])); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <h5>Belum Ada Dokumentasi</h5>
                        <p class="text-muted">Belum ada kegiatan yang didokumentasikan. Silakan cek lagi nanti!</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- pop up detail -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 pb-4 px-4">
                    <img src="" alt="Detail Dokumentasi" id="modalImage" class="modal-img mb-3">
                    <h4 id="modalTitle" class="fw-bold mt-2">Judul Kegiatan</h4>
                    <p id="modalDesc" class="text-muted">Deskripsi lengkap kegiatan akan muncul di sini.</p>
                    <div class="d-flex gap-4 text-muted small">
                        <span id="modalTanggal"><i class="far fa-calendar-alt"></i> Tanggal</span>
                        <span id="modalLokasi"><i class="fas fa-map-marker-alt"></i> Lokasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- lod admin-->
    <div class="admin-badge">
        <a href="admin/login.html" class="btn-admin">
            <i class="fas fa-user-shield"></i> Login Admin
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
        const galleryModal = document.getElementById('galleryModal');
        if (galleryModal) {
            galleryModal.addEventListener('show.bs.modal', function(event) {
                const card = event.relatedTarget;
                document.getElementById('modalImage').src = card.getAttribute('data-img');
                document.getElementById('modalTitle').innerText = card.getAttribute('data-title');
                document.getElementById('modalDesc').innerText = card.getAttribute('data-desc');
                document.getElementById('modalTanggal').innerHTML = '<i class="far fa-calendar-alt"></i> ' + card.getAttribute('data-tanggal');
                document.getElementById('modalLokasi').innerHTML = '<i class="fas fa-map-marker-alt"></i> ' + card.getAttribute('data-lokasi');
            });
        }
    </script>
</body>
</html>
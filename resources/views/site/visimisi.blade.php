<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi Misi - RSHP UNAIR</title>
   <style>
        /* Styles for a consistent header */
        .top-nav {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }
        .top-nav nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-nav .left-logo {
            max-height: 50px;
        }
        .top-nav nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        .top-nav nav ul li a {
            text-decoration: none;
            color: #6588e8;
            font-weight: 600;
            transition: color 0.3s;
        }
        .top-nav nav ul li a:hover {
            color: #4a6fc4;
        }
        /* Keep other specific styles for index.html from dashboard.css if needed */
        /*
 * ========================================
 * File: dashboard.css
 * Deskripsi: Gaya khusus untuk halaman dashboard dan sub-halamannya
 * ========================================
 */

/* ================== General Page Layout ================== */
* {
    box-sizing: border-box;
}

html, body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
    height: 100%;
}

/* ================== Main Container ================== */
.page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    min-height: calc(100vh - 120px); /* Adjust based on header/footer height */
}

/* ================== Top Navigation Bar ================== */
.top-nav {
            background-color: white; /* Navigasi tetap putih agar bersih */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Tambah bayangan agar menonjol */
            padding: 1rem 2rem;
}

.top-nav nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
}

.top-nav .left-logo {
            max-height: 50px;
}

.top-nav nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
}

.top-nav nav ul li a {
            text-decoration: none;
            color: #6588e8; /* Warna tautan sesuai brand */
            font-weight: 600;
            transition: color 0.3s;
}

.top-nav nav ul li a:hover {
            color: #4a6fc4;
}

/* ================== Main Content Area ================== */
.main-content {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin: 20px 0;
}

/* ================== Page Headers ================== */
.page-header {
    background: linear-gradient(135deg, #6588e8, #4a6fc4);
    color: white;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 600;
}

.page-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
}

/* ================== Dashboard Grid & Cards ================== */
.dashboard-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
}

.welcome-section {
    background: linear-gradient(135deg, #6588e8, #4a6fc4);
    color: white;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.welcome-section h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 600;
}

.welcome-section p {
    margin: 10px 0 0 0;
    font-size: 16px;
    opacity: 0.9;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.dashboard-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e0e0e0;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.dashboard-card h3 {
    color: #6588e8;
    margin-bottom: 15px;
    font-size: 20px;
}

.dashboard-card p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* ================== Registration/Online Form Section ================== */
.registration-section {
    background: white;
    border-radius: 10px;
    padding: 30px;
    margin: 20px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.registration-section h2 {
    color: #6588e8;
    margin-bottom: 15px;
    font-size: 24px;
}

.registration-section p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* ================== Buttons ================== */
.btn-dashboard {
    background-color: #f1c40f;
    color: black;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-dashboard:hover {
    background-color: #e2b607;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-logout {
    background-color: #e74c3c;
    color: white;
}

.btn-logout:hover {
    background-color: #c0392b;
}

.btn-primary {
    background-color: #6588e8;
    color: white;
}

.btn-primary:hover {
    background-color: #4a6fc4;
}

/* ================== Information Box ================== */
.info-box {
    background: #e8f4fd;
    border-left: 4px solid #6588e8;
    padding: 20px;
    margin: 20px 0;
    border-radius: 0 8px 8px 0;
}

.info-box h3 {
    color: #6588e8;
    margin-top: 0;
}

/* ================== Video/Media Section ================== */
.content-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
  flex-wrap: wrap; 
  margin: 20px auto;
  max-width: 1100px;
  margin-bottom: 50px;
}

.left-section {
  flex: 1;
  min-width: 280px;
  text-align: center;
}

.left-section p {
  margin: 15px 0;
  line-height: 1.5;
}
.video-container {
  position: relative;
  padding-bottom: 56.25%; 
  height: 0;
  overflow: hidden;
  max-width: 100%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.video-container iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.right-section {
  flex: 1;
  min-width: 300px;
}


/* ================== Footer ================== */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin-top: auto;
    width: 100%;
}

footer p {
    margin: 0;
    font-size: 14px;
}

/* ================== Responsive Design ================== */
@media (max-width: 768px) {
    .top-nav {
        padding: 1rem;
    }
    
    .top-nav nav {
        flex-direction: column;
        gap: 15px;
    }
    
    .top-nav nav ul {
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }
    
    .page-container,
    .dashboard-container {
        padding: 15px;
        margin: 15px auto;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .main-content {
        padding: 20px;
        margin: 15px 0;
    }
    
    .page-header {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .page-header h1 {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .btn-dashboard {
        padding: 10px 20px;
        font-size: 13px;
    }
    
    .dashboard-card {
        padding: 20px;
    }
    
    .media-section {
        padding: 20px;
    }
}

/* ================== Index Page Specific Styles ================== */
.shortcut {
    background-color: #f4f4f4;
    padding: 10px 0;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.shortcut a {
    margin: 0 15px;
    text-decoration: none;
    color: #555;
    font-weight: bold;
    font-size: 14px;
}

.content-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
    gap: 40px;
}

.content-wrapper-home {
    max-width: 1400px; /* Allow more width for the home page layout */
}

.left-section {
    flex: 1;
    max-width: 40%; /* Give more space to the video */
}

.left-section p {
    font-size: 16px;
    text-align: left;
    line-height: 1.7;
    color: #555;
    margin: 20px 0;
}

.btn-yellow {
    background-color: #f1c40f;
    color: black;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-blue {
    background-color: #6588e8;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition: background-color 0.3s;
}

.right-section {
    flex: 1.5; /* Allow this section to take more space */
    display: flex;
    justify-content: center;
    align-items: center;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.video-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

    /* Custom styles for visimisi page */
    .head {
        text-align: center;
        padding: 2rem;
        color: #333;
    }
    .content {
        text-align: center;
        padding: 2rem;
        background-color: #fff;
        margin: 20px auto;
        border-radius: 10px;
        max-width: 900px;
    }
    .content ol {
        display: inline-block; text-align: left;
    }
    </style>
</head> 

    <header class="top-nav">
<x-navigation>

</x-navigation>

    </header>

<div class="shortcut">
            <a href="#unair">UNAIR</a>  
            <a href="#fkh-unair">FKH UNAIR</a>  
            <a href="#cyber-campus">Cyber Campus</a>
</div>

<body>
    
    <header class="head">
        <h1>Visi, Misi, dan Tujuan RSHP Universitas Airlangga</h1>
        <p>Rumah Sakit Hewan Pendidikan sebagai wahana pelayanan, pendidikan, dan pengabdian pada masyarakat.</p>
    </header>
    
    <section class="content">
        <h2>Visi</h2>
            <p>
                Menjadi Rumah Sakit Hewan Pendidikan terkemuka di tingkat nasional dan internasional dalam pemberian pelayanan paripurna,
                pendidikan, dan penelitian di bidang kesehatan hewan, yang unggul dan mandiri serta bermartabat berdasarkan moral, agama,
                etika dengan tetap berorientasi pada kesejahteraan masyarakat.
            </p>

        <h2>Misi</h2>
            <ol>
                <li>Menyelenggarakan fungsi pelayanan terintegrasi, bermutu dan mengutamakan keselamatan dan kesehatan pasien (klien).</li>
                <li>Menyelenggarakan pendidikan dan pelatihan terintegrasi bidang kedokteran hewan dan kesehatan lainnya untuk menghasilkan lulusan atau tenaga kesehatan yang kompeten di bidangnya.</li>
                <li>Melakukan penelitian terintegrasi berbasis pada keunggulan bidang kedokteran hewan dan kesehatan lainnya yang berorientasi pada produk inovasi.</li>
                <li>Menjadi pusat rujukan pelayanan kedokteran hewan dan kesehatan lain yang unggul.</li>
                <li>Mengembangkan manajemen rumah sakit hewan yang produktif, efisien, bermutu, dan berbasis kinerja.Mendukung pendidikan kedokteran hewan di lingkungan Universitas Airlangga.</li>
            </ol>

        <h2>Tujuan</h2>
            <p>
                Menjadi Rumah Sakit Hewan yang adaptif, kreatif dan proaktif terhadap tuntutan perkembangan ilmu pengetahuan dan teknologi di bidang pengobatan kesehtan hewan
                <br>Menjadi Rumah Sakit Hewan mandiri yang bertatakelola baik
            </p>
</section>

<x-footer>
    
</x-footer>
</body>
</html>

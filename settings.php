<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Pengaturan default
$colorScheme = isset($_SESSION['colorScheme']) ? $_SESSION['colorScheme'] : '#007bff';
$sidebarColor = isset($_SESSION['sidebarColor']) ? $_SESSION['sidebarColor'] : 'dark';
$fontFamily = isset($_SESSION['fontFamily']) ? $_SESSION['fontFamily'] : 'Open Sans';
$fontSize = isset($_SESSION['fontSize']) ? $_SESSION['fontSize'] : '14px';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menyimpan pengaturan ke sesi
    $_SESSION['colorScheme'] = $_POST['colorScheme'];
    $_SESSION['sidebarColor'] = $_POST['sidebarColor'];
    $_SESSION['fontFamily'] = $_POST['fontFamily'];
    $_SESSION['fontSize'] = $_POST['fontSize'];
    header("Location: settings.php"); // Refresh halaman setelah submit
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sidebar.css"> <!-- File CSS Sidebar -->
    <style>
        .color-scheme-option {
            width: 40px;
            height: 40px;
            margin: 5px;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
        }
        .color-scheme-selected {
            border: 3px solid red;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="header">
            Edit Setting Layout
        </div>

        <div class="content">
            <div class="container mt-4">
                <form method="POST" action="settings.php">
                    <div class="mb-3">
                        <label for="colorScheme" class="form-label">Color Scheme</label><br>
                        <div>
                            <div class="color-scheme-option" style="background-color: #007bff;" data-color="#007bff"></div>
                            <div class="color-scheme-option" style="background-color: #6f42c1;" data-color="#6f42c1"></div>
                            <div class="color-scheme-option" style="background-color: #dc3545;" data-color="#dc3545"></div>
                            <div class="color-scheme-option" style="background-color: #28a745;" data-color="#28a745"></div>
                            <div class="color-scheme-option" style="background-color: #ffc107;" data-color="#ffc107"></div>
                            <div class="color-scheme-option" style="background-color: #6c757d;" data-color="#6c757d"></div>
                        </div>
                        <input type="hidden" name="colorScheme" id="colorScheme" value="<?= $colorScheme; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="backgroundLogo" class="form-label">Background Logo</label>
                        <select class="form-select" id="backgroundLogo" name="backgroundLogo">
                            <option value="default">Sesuai Color Scheme</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sidebarColor" class="form-label">Sidebar Color</label>
                        <select class="form-select" id="sidebarColor" name="sidebarColor">
                            <option value="dark" <?= $sidebarColor == 'dark' ? 'selected' : ''; ?>>Dark</option>
                            <option value="light" <?= $sidebarColor == 'light' ? 'selected' : ''; ?>>Light</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fontFamily" class="form-label">Font Family</label>
                        <select class="form-select" id="fontFamily" name="fontFamily">
                            <option value="Open Sans" <?= $fontFamily == 'Open Sans' ? 'selected' : ''; ?>>Open Sans (Default)</option>
                            <option value="Arial" <?= $fontFamily == 'Arial' ? 'selected' : ''; ?>>Arial</option>
                            <option value="Roboto" <?= $fontFamily == 'Roboto' ? 'selected' : ''; ?>>Roboto</option>
                            <option value="Times New Roman" <?= $fontFamily == 'Times New Roman' ? 'selected' : ''; ?>>Times New Roman</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fontSize" class="form-label">Font Size</label>
                        <input type="range" class="form-range" min="10" max="24" step="1" id="fontSize" name="fontSize" value="<?= str_replace('px', '', $fontSize); ?>">
                        <span id="fontSizeDisplay"><?= $fontSize; ?></span>px
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- JavaScript -->
<script>
    // Fungsi untuk menampilkan ukuran font secara dinamis
    document.getElementById('fontSize').addEventListener('input', function() {
        document.getElementById('fontSizeDisplay').textContent = this.value + 'px';
    });

    // Fungsi untuk memilih skema warna
    document.querySelectorAll('.color-scheme-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.color-scheme-option').forEach(opt => opt.classList.remove('color-scheme-selected'));
            this.classList.add('color-scheme-selected');
            document.getElementById('colorScheme').value = this.getAttribute('data-color');
        });
    });

    // Fungsi toggle sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');

        // Simpan status sidebar ke localStorage
        if (sidebar.classList.contains('collapsed')) {
            localStorage.setItem('sidebarStatus', 'collapsed');
        } else {
            localStorage.setItem('sidebarStatus', 'expanded');
        }
    }

    // Terapkan status sidebar dari localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarStatus = localStorage.getItem('sidebarStatus');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');

        // Terapkan kelas no-transition untuk menghilangkan efek transisi sementara
        sidebar.classList.add('no-transition');
        mainContent.classList.add('no-transition');

        if (sidebarStatus === 'collapsed') {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('collapsed');
        }

        // Hapus kelas no-transition setelah beberapa saat agar efek transisi normal
        setTimeout(() => {
            sidebar.classList.remove('no-transition');
            mainContent.classList.remove('no-transition');
        }, 100);
    });
</script>

</body>
</html>

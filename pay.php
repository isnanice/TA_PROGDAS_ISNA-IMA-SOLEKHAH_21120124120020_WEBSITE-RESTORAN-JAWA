<?php
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$product = isset($_POST['product']) ? $_POST['product'] : '';
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : 0;

// Modul 1 array
$products = [ 
    'Brekecek' => 30000,
    'Rawon' => 50000,
    'Bakmi Jawa' => 30000,
    'Nasi Liwet' => 35000,
    'Wedang Tahu' => 20000,
    'Es Dawet Ayu' => 20000,
    'Es Pacar Keling' => 20000,
    'Es Degan' => 20000
];

    // Modul 2 Pengkondisian
    if (isset($products[$product])) {
        $harga = $products[$product]; 
    } else {
        $harga = 0; 
    }

    $total = $harga * $jumlah; 

    
    if (isset($_POST['money_paid'])) {
        $moneyPaid = $_POST['money_paid']; 
    } else {
        $moneyPaid = 0; 
    }

    $shortage = $total - $moneyPaid; 
    $excess = $moneyPaid - $total;   


    if ($moneyPaid >= $total) {
        $isEnough = true; 
    } else {
        $isEnough = false; 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section id="Home">
        <nav>
            <div class="logo">
                <img src="image/logo.png" alt="Logo">
            </div>
            <ul>
                <li><a href="index.php#Home">Home</a></li>
                <li><a href="index.php#About">About</a></li>
                <li><a href="index.php#Menu">Menu</a></li>
                <li><a href="index.php#Review">Review</a></li>
                <li><a href="order.php#Order">Order</a></li>
            </ul>
        </nav>

        <div class="pay" id="Pay">
            <h1><span>Matur Nuwun!</span></h1>

            <div class="pay_main">
                <div class="pay_image">
                    <img src="image/pay_image.png" alt="Pay Image">
                </div>

                <div class="pay_box">
                    <h1>Detail Pemesanan</h1>
                    <div class="pay_detail">
                        <p><b>Nama:</b> <?= htmlspecialchars($nama); ?></p>
                        <p><b>Nomor Hp:</b> <?= htmlspecialchars($nomor); ?></p>
                        <p><b>Email:</b> <?= htmlspecialchars($email); ?></p>
                        <p><b>Alamat:</b> <?= htmlspecialchars($address); ?></p>
                        <p><b>Menu:</b> <?= htmlspecialchars($product); ?></p>
                        <p><b>Jumlah menu:</b> <?= htmlspecialchars($jumlah); ?></p>
                        <p class="total"><b>Harga:</b> Rp <?= number_format($total, 0, ',', '.'); ?></p>
                        <p><b>Jumlah uang yang diserahkan:</b> Rp <?= number_format($moneyPaid, 0, ',', '.'); ?></p>

                        <?php if ($moneyPaid < $total): ?>
                            <p class="error"><strong>Uang Anda Kurang! Silakan masukkan jumlah yang sesuai.</strong></p>
                            <form action="order.php" method="POST">
                                <button type="submit" class="cancel_btn">Balik Maneh</button>
                            </form>
                        <?php elseif ($moneyPaid == $total): ?>
                            <p><strong>Tidak ada kembalian.</strong></p>
                            <form action="confirmation.php" method="POST">
                                <button type="submit" class="pay_btn">Konfirmasi Pembayaran</button>
                            </form>
                        <?php else: ?>
            <p><strong>Uang Kembalian Anda:</strong> Rp <?= number_format($excess, 0, ',', '.'); ?></p>
            <form action="confirmation.php" method="POST">
                <button type="submit" class="pay_btn">Konfirmasi Pembayaran</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

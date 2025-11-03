<?php
if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    echo "<span style='color:green; font-weight:bold;'>
    ✅ Form berhasil dikirim!<br>
    <b>Nama:</b> $name<br>
    <b>Email:</b> $email<br>
    <b>Pesan:</b> $message
    </span>";
}
?>

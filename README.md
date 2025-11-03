# Tugas-PWEB-Week7
Nama  : Reza Afzaal Faizullah Taqy <br>
NRP   : 5025241051

<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/04ff6b56-9e46-4642-96d0-347c285101c9" />


1. Penjelasan File index.php

```
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Form Without Page Refresh</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

```

Penjelasan:

Menggunakan Bootstrap 4.6 untuk tampilan yang rapi dan responsif.

Memuat jQuery agar kita bisa memakai AJAX dan manipulasi DOM dengan mudah.

Judul halaman: “Submit Form Without Page Refresh”.

2. Struktur Form

```
<form id="ContactForm" method="post">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
  </div>

  <div class="form-group">
    <label for="email">Email Address:</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
  </div>

  <div class="form-group">
    <label for="message">Message:</label>
    <textarea class="form-control" id="message" name="message" placeholder="Write something..."></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div class="message_box mt-3"></div>

```
Penjelasan:

Form memiliki tiga input: name, email, dan message.

ID form adalah ContactForm (digunakan oleh jQuery untuk seleksi).

Elemen <div class="message_box"> digunakan untuk menampilkan hasil dari ajax.php.

3. Fungsi Validasi Email.

```
function isValidEmailAddress(emailAddress) {
  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~]+...$/i;
  return pattern.test(emailAddress);
}

```

Penjelasan:

Fungsi ini memvalidasi format email menggunakan regular expression (regex).

Mengembalikan true jika format email valid, dan false jika tidak.


4. Script jQuery untuk AJAX

```
$(document).ready(function() {
  var delay = 2000; 

  $('#ContactForm').on('submit', function(e) {
    e.preventDefault();

    var name = $('#name').val().trim();
    var email = $('#email').val().trim();
    var message = $('#message').val().trim();

```

5. Validasi Input.

```
if(name == '') { ... }
if(email == '') { ... }
if(!isValidEmailAddress(email)) { ... }
if(message == '') { ... }

```

Penjelasan:

Mengecek apakah semua kolom terisi dan format email benar.

Jika ada error, pesan ditampilkan dalam .message_box tanpa mengirim ke server.

6. Mengirim Data ke Server (AJAX)

```
$.ajax({
  type: "POST",
  url: "ajax.php",
  data: {name: name, email: email, message: message},
  beforeSend: function() {
    $('.message_box').html('<img src="Loader.gif" width="25" height="25"/> Sending...');
  },
  success: function(data) {
    setTimeout(function() {
      $('.message_box').html(data);
      $('#ContactForm')[0].reset();
    }, delay);
  },
  error: function() {
    $('.message_box').html('<span class="text-danger">Error submitting form!</span>');
  }
});
```

Penjelasan:

type: "POST" → metode pengiriman data.

url: "ajax.php" → file tujuan untuk memproses data.

beforeSend → menampilkan animasi loading sebelum proses.

success → menampilkan hasil yang dikirim balik oleh ajax.php.

error → menangani jika request gagal.

setTimeout → memberi jeda 2 detik agar animasi loading terlihat dulu.

$('#ContactForm')[0].reset() → mengosongkan form setelah sukses.

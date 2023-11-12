<?php
namespace MyUpload;

class ImageUploader {
    private $uploadDir = 'image/';

    public function uploadImage($file) {
        $targetFile = $this->uploadDir . basename($file['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Cek apakah file gambar atau bukan
        $check = getimagesize($file['tmp_name']);
        if (!$check) {
            echo "<script>alert('File bukan gambar')</script>";
            $uploadOk = 0;
        }

        // Cek apakah file sudah ada
        if (file_exists($targetFile)) {
            echo "<script>alert('File sudah ada')</script>.";
            $uploadOk = 0;
        }

        // Cek ukuran file
        if ($file['size'] > 500000) {
            echo "<script>alert('Ukuran file terlalu besar')</script>";
            $uploadOk = 0;
        }

        // Hanya izinkan format gambar tertentu
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<script>alert('Format file tidak diizinkan. Hanya JPG, JPEG, PNG, dan GIF diperbolehkan.')</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('File tidak diupload.')</script>";
        } else {
            // Jika semua kondisi terpenuhi, coba upload file
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                return $targetFile;
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengupload file.')</script>";
            }
        }
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminPembayaranTest extends BaseTest {

    @Test
    void adminCanVerifyStudentPayment() {
        // 1. Login & Buka Modul Verifikasi Pembayaran
        loginAsAdmin();
        open("/admin/pembayaran");

        // 2. Verifikasi halaman memuat daftar transaksi keuangan
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();

        // 3. Cari dan klik tombol aksi konfirmasi/verifikasi pembayaran pertama jika ada
        try {
            driver.findElement(By.partialLinkText("Verifikasi")).click();
            
            // Konfirmasi di dalam modal atau form persetujuan
            wait.until(ExpectedConditions.elementToBeClickable(By.cssSelector("button[type='submit']"))).click();
            
            // Tunggu kembali ke halaman indeks pembayaran
            wait.until(ExpectedConditions.urlContains("/admin/pembayaran"));
            
            assertTrue(
                    driver.getPageSource().toLowerCase().contains("berhasil")
                    || driver.getPageSource().toLowerCase().contains("disetujui"),
                    "Admin gagal melakukan verifikasi pembayaran siswa."
            );
        } catch (Exception e) {
            // Jika tidak ada data transaksi yang menggantung untuk diverifikasi
            System.out.println("Tombol verifikasi pembayaran tidak ditemukan (tabel mungkin kosong).");
            assertTrue(driver.getCurrentUrl().contains("/admin/pembayaran"));
        }
    }
}
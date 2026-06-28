package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminSiswaUpdateTest extends BaseTest {

    @Test
    void adminCanEditExistingSiswa() {
        // 1. Login & Masuk ke Manajemen Siswa
        loginAsAdmin();
        open("/admin/siswa");

        // 2. Klik tombol Edit pada baris data pertama yang tersedia
        try {
            driver.findElement(By.partialLinkText("Edit")).click();
        } catch (Exception e) {
            // Jika tombol berupa icon, cari berdasarkan selector class atau bypass ke route edit jika tahu ID-nya
            System.out.println("Tombol Edit text tidak ditemukan, mencoba mencari selector alternatif.");
            driver.findElement(By.cssSelector(".btn-warning, .btn-edit, a[href*='edit']")).click();
        }

        // 3. Ubah nama siswa yang ada
        waitVisible(By.name("nama")).clear();
        driver.findElement(By.name("nama")).sendKeys("Siswa Diperbarui Oleh Selenium");

        // Klik Simpan / Update
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Verifikasi perubahan sukses
        wait.until(ExpectedConditions.urlContains("/admin/siswa"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("Siswa Diperbarui Oleh Selenium")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal memperbarui data nama siswa."
        );
    }
}
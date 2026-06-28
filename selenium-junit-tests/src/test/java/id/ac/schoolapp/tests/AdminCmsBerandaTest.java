package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminCmsBerandaTest extends BaseTest {

    @Test
    void adminCanUpdateLandingPageBanner() {
        // 1. Login & Masuk ke CMS Beranda
        loginAsAdmin();
        open("/admin/cms/beranda");

        // 2. Ubah Tagline Banner Utama / Selamat Datang di Beranda Web
        waitVisible(By.name("judul_banner")).clear();
        driver.findElement(By.name("judul_banner")).sendKeys("Selamat Datang di SIT LETSS-IT");

        try {
            driver.findElement(By.name("sub_judul")).clear();
            driver.findElement(By.name("sub_judul")).sendKeys("Membentuk Generasi Qurani, Cerdas, dan Berteknologi.");
        } catch (Exception e) {
            // Abaikan jika tidak ada sub-judul
        }

        // Klik Simpan / Perbarui
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 3. Verifikasi Keberhasilan Aksi CMS
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().toLowerCase().contains("berhasil")
                || driver.getPageSource().toLowerCase().contains("diperbarui"),
                "Admin gagal memperbarui konten CMS Beranda utama."
        );
    }
}
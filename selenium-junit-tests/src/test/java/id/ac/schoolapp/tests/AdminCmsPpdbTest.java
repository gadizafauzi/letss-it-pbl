package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminCmsPpdbTest extends BaseTest {

    @Test
    void adminCanUpdatePpdbInformationSettings() {
        // 1. Login & Masuk ke Pengaturan Informasi PPDB publik
        loginAsAdmin();
        open("/admin/cms/ppdb");

        // 2. Mengubah teks alur pendaftaran atau kuota informasi PPDB
        try {
            waitVisible(By.name("alur_pendaftaran")).clear();
            driver.findElement(By.name("alur_pendaftaran")).sendKeys("1. Isi Form, 2. Bayar, 3. Verifikasi, 4. Pengumuman.");
        } catch (Exception e) {
            // Jika field bernama keterangan/informasi
            waitVisible(By.name("keterangan")).clear();
            driver.findElement(By.name("keterangan")).sendKeys("Informasi PPDB Tahun Ajaran Baru Berhasil Diperbarui.");
        }

        // Klik Simpan
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 3. Validasi
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getPageSource().toLowerCase().contains("berhasil")
                || driver.getPageSource().toLowerCase().contains("sukses"),
                "Admin gagal memperbarui konfigurasi teks CMS PPDB."
        );
    }
}
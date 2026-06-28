package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminBeritaCrudTest extends BaseTest {

    @Test
    void adminCanCreateNewNewsArticle() {
        // 1. Login sebagai admin
        loginAsAdmin();
        
        // 2. Navigasi ke CMS Berita
        open("/admin/cms/berita");

        // 3. Buka form pembuatan berita baru
        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/cms/berita/create");
        }

        // 4. Isi konten berita
        waitVisible(By.name("judul")).sendKeys("Pengumuman Pelaksanaan PBL Semester Ini");
        
        // Mengisi area konten/body berita
        try {
            driver.findElement(By.name("konten")).sendKeys("Ini adalah teks konten berita hasil pengujian otomatis.");
        } catch (Exception e) {
            // Fallback jika field bernama 'isi' atau 'body'
            driver.findElement(By.name("isi")).sendKeys("Ini adalah teks konten berita hasil pengujian otomatis.");
        }
        
        // Submit Form
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 5. Tunggu proses redirect kembali ke halaman utama manajemen berita
        wait.until(ExpectedConditions.urlContains("/admin/cms/berita"));
        assertPageDoesNotShowServerError();

        // 6. Verifikasi keberhasilan pembuatan artikel berita
        assertTrue(
                driver.getPageSource().contains("Pelaksanaan PBL")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal memposting atau menyimpan berita baru."
        );
    }
}

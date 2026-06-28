package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Kategori Berita Test")
public class AdminKategoriBeritaTest extends BaseTest {

    @Test
    @DisplayName("Admin can view kategori berita page")
    void testAdminKategoriBeritaView() {
        loginAsAdmin();

        open("/admin/cms/berita/kategori");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/cms/berita/kategori"), "Gagal membuka halaman Kategori Berita");

        // Cek adanya tabel kategori
        assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel kategori berita tidak ditemukan");
    }
}

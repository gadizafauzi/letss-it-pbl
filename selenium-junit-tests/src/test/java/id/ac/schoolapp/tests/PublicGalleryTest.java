package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class PublicGalleryTest extends BaseTest {

    @Test
    void publicUserCanViewSchoolActivitiesGallery() {
        // 1. Buka landing page utama publik / galeri sekolah
        open("/");

        // 2. Verifikasi halaman memuat dokumentasi kegiatan sekolah (tag img atau class gallery)
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();

        // Memastikan halaman memuat setidaknya aset gambar dokumentasi sekolah Islam Terpadu
        boolean hasImages = !driver.findElements(By.tagName("img")).isEmpty();
        assertTrue(hasImages, "Halaman utama gagal memuat aset gambar dokumentasi sekolah.");
    }
}
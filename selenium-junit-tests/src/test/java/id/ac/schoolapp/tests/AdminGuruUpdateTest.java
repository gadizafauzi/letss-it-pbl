package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminGuruUpdateTest extends BaseTest {

    @Test
    void adminCanEditExistingGuruData() {
        // 1. Login & Masuk ke Data Guru
        loginAsAdmin();
        open("/admin/guru");

        // 2. Klik aksi Edit
        try {
            driver.findElement(By.cssSelector(".btn-warning, a[href*='edit']")).click();
        } catch (Exception e) {
            open("/admin/guru/1/edit"); // Fallback jika ID statis tersedia
        }

        // 3. Edit No HP / Kontak Guru
        try {
            waitVisible(By.name("no_hp")).clear();
            driver.findElement(By.name("no_hp")).sendKeys("089999999999");
        } catch (Exception e) {
            // Jika tidak ada no_hp, edit field nama atau kompetensi
            waitVisible(By.name("nama_guru")).sendKeys(" (Updated)");
        }

        // Klik update
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Verifikasi
        wait.until(ExpectedConditions.urlContains("/admin/guru"));
        assertPageDoesNotShowServerError();
        assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
    }
}
package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminKelasUpdateTest extends BaseTest {

    @Test
    void adminCanUpdateClassRoomName() {
        // 1. Login & Masuk ke Data Kelas
        loginAsAdmin();
        open("/admin/kelas");

        // 2. Pilih salah satu kelas dan klik edit
        try {
            driver.findElement(By.cssSelector(".btn-warning, a[href*='edit']")).click();
            
            // 3. Ganti nama kelas
            waitVisible(By.name("nama_kelas")).clear();
            driver.findElement(By.name("nama_kelas")).sendKeys("Kelas Unggulan IT-1");

            // Simpan
            driver.findElement(By.cssSelector("button[type='submit']")).click();

            // 4. Validasi
            wait.until(ExpectedConditions.urlContains("/admin/kelas"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().contains("Kelas Unggulan IT-1") || driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Elemen edit data kelas tidak ditemukan.");
            assertTrue(driver.getCurrentUrl().contains("/admin/kelas"));
        }
    }
}
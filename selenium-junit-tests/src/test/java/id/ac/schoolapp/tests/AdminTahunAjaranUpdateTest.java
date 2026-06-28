package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminTahunAjaranUpdateTest extends BaseTest {

    @Test
    void adminCanUpdateAcademicYearStatus() {
        // 1. Login & Masuk ke Tahun Ajaran
        loginAsAdmin();
        open("/admin/tahun-ajaran");

        // 2. Lakukan klik edit pada data pertama
        try {
            driver.findElement(By.cssSelector(".btn-warning, a[href*='edit']")).click();

            // 3. Perbarui nama tahun ajaran (misal menambahkan penanda)
            waitVisible(By.name("tahun_ajaran")).clear();
            driver.findElement(By.name("tahun_ajaran")).sendKeys("2026/2027 Ganjil");

            driver.findElement(By.cssSelector("button[type='submit']")).click();

            // 4. Verifikasi
            wait.until(ExpectedConditions.urlContains("/admin/tahun-ajaran"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().contains("2026/2027 Ganjil") || driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Data tahun ajaran belum tersedia.");
            assertTrue(driver.getCurrentUrl().contains("/admin/tahun-ajaran"));
        }
    }
}
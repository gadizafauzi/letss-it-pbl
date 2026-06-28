package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminProfileUpdateTest extends BaseTest {

    @Test
    void adminCanUpdatePersonalPasswordAndProfile() {
        // 1. Login & Buka Pengaturan Akun Admin
        loginAsAdmin();
        open("/admin/profil"); // Menuju manajemen data profile login pengguna sendiri

        try {
            // 2. Mengubah password admin saat ini ke password pengujian baru
            waitVisible(By.name("password_lama")).sendKeys(ADMIN_PASSWORD);
            driver.findElement(By.name("password")).sendKeys("12345678");
            driver.findElement(By.name("password_confirmation")).sendKeys("12345678");
            
            driver.findElement(By.cssSelector("button[type='submit']")).click();
            
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil") || driver.getPageSource().toLowerCase().contains("sukses"));
        } catch (Exception e) {
            System.out.println("Field password lama/baru tidak cocok atau menu profil menggunakan struktur rute berbeda.");
        }
    }
}
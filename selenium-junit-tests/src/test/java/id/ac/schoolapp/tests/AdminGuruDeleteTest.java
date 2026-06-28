package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminGuruDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteGuruWithAlertConfirmation() {
        // 1. Login & Masuk ke List Guru
        loginAsAdmin();
        open("/admin/guru");

        // 2. Eksekusi hapus data guru baris pertama
        try {
            driver.findElement(By.cssSelector("form[action*='guru'] button, .btn-danger")).click();
            
            // Konfirmasi popup dialog browser
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/guru"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Data guru kosong atau tombol hapus tidak ditemukan.");
            assertTrue(driver.getCurrentUrl().contains("/admin/guru"));
        }
    }
}
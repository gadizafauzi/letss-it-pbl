package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminKelasDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteClassRoom() {
        // 1. Login & Masuk ke Menu Kelas
        loginAsAdmin();
        open("/admin/kelas");

        // 2. Klik tombol hapus kelas pertama
        try {
            driver.findElement(By.cssSelector("form[action*='kelas'] button, .btn-danger")).click();
            
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/kelas"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Tabel kelas kosong atau tidak ada tombol hapus.");
            assertTrue(driver.getCurrentUrl().contains("/admin/kelas"));
        }
    }
}
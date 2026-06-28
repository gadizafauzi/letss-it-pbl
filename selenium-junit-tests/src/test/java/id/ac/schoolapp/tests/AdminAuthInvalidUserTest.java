package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminAuthInvalidUserTest extends BaseTest {

    @Test
    void adminLoginShouldRejectCompletelyInvalidUser() {
        // 1. Buka Halaman Login
        open("/admin/login");

        // 2. Isi data asal/tidak terdaftar di sistem database manapun
        waitVisible(By.id("admin_login")).sendKeys("user_palsu_123");
        driver.findElement(By.id("admin_password")).sendKeys("SembarangPassword");
        driver.findElement(By.id("adminBtn")).click();

        // 3. Menunggu validasi error handling dari controller auth
        wait.until(ExpectedConditions.or(
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-danger")),
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-error")),
                ExpectedConditions.urlContains("/admin/login")
        ));

        // 4. Pastikan user ditolak masuk dashboard
        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getCurrentUrl().contains("/admin/login") 
                || driver.getPageSource().toLowerCase().contains("gagal"),
                "Sistem meloloskan user tidak valid masuk ke sistem!"
        );
    }
}
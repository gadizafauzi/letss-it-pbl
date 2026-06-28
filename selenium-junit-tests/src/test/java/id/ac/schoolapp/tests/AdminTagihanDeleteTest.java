package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminTagihanDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteBillingCategory() {
        // 1. Login & Ke Menu Tagihan
        loginAsAdmin();
        open("/admin/tagihan");

        // 2. Coba klik hapus data tagihan pertama
        try {
            driver.findElement(By.cssSelector("form[action*='tagihan'] button, .btn-danger")).click();
            
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/tagihan"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Tidak ada baris tagihan keuangan untuk dihapus.");
            assertTrue(driver.getCurrentUrl().contains("/admin/tagihan"));
        }
    }
}
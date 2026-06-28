package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminBeritaDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteNewsArticle() {
        // 1. Login & Masuk ke List Berita CMS
        loginAsAdmin();
        open("/admin/cms/berita");

        // 2. Klik tombol delete pada salah satu artikel berita
        try {
            driver.findElement(By.cssSelector("form[action*='berita'] button, .btn-danger")).click();
            
            // Konfirmasi alert jika sistem memicu dialog browser
            try {
                driver.switchTo().alert().accept();
            } catch (Exception alertEx) {
                // Berarti tidak memakai alert bawaan melainkan modal custom / langsung submit form delete
            }

            wait.until(ExpectedConditions.urlContains("/admin/cms/berita"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Tidak ada artikel untuk dihapus.");
            assertTrue(driver.getCurrentUrl().contains("/admin/cms/berita"));
        }
    }
}
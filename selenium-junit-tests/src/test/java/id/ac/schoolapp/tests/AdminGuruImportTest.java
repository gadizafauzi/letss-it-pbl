package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Guru Import Test")
public class AdminGuruImportTest extends BaseTest {

    @Test
    @DisplayName("Admin can view guru import page")
    void testAdminGuruImportView() {
        loginAsAdmin();

        open("/admin/guru/import");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/guru/import"), "Gagal membuka halaman Import Guru");

        // Cek adanya form upload file dan tombol download template
        assertTrue(driver.findElements(By.cssSelector("input[type='file']")).size() > 0, "Form upload file excel tidak ditemukan");
        assertTrue(driver.findElements(By.cssSelector("a[href*='template']")).size() > 0, "Tombol download template tidak ditemukan");
    }
}

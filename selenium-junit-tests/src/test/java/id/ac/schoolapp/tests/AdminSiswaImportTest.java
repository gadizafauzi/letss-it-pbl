package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Siswa Import Test")
public class AdminSiswaImportTest extends BaseTest {

    @Test
    @DisplayName("Admin can view siswa import page")
    void testAdminSiswaImportView() {
        loginAsAdmin();

        open("/admin/siswa/import");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/siswa/import"), "Gagal membuka halaman Import Siswa");

        // Cek adanya form upload file dan tombol download template
        assertTrue(driver.findElements(By.cssSelector("input[type='file']")).size() > 0, "Form upload file excel tidak ditemukan");
        assertTrue(driver.findElements(By.cssSelector("a[href*='template']")).size() > 0, "Tombol download template tidak ditemukan");
    }
}

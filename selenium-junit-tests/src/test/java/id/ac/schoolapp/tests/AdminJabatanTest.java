package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Jabatan Test")
public class AdminJabatanTest extends BaseTest {

    @Test
    @DisplayName("Admin can view jabatan page")
    void testAdminJabatanView() {
        loginAsAdmin();

        open("/admin/jabatan");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/jabatan"), "Gagal membuka halaman Jabatan");

        // Cek adanya tabel jabatan
        assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel jabatan tidak ditemukan");
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Jenis Tagihan Test")
public class AdminJenisTagihanTest extends BaseTest {

    @Test
    @DisplayName("Admin can view jenis tagihan page")
    void testAdminJenisTagihanView() {
        loginAsAdmin();

        open("/admin/jenis-tagihan");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/jenis-tagihan"), "Gagal membuka halaman Jenis Tagihan");

        // Cek adanya tabel jenis tagihan
        assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel jenis tagihan tidak ditemukan");
    }
}

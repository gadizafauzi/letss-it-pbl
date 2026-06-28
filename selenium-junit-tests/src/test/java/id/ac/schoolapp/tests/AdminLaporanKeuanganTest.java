package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Laporan Keuangan Test")
public class AdminLaporanKeuanganTest extends BaseTest {

    @Test
    @DisplayName("Admin can view laporan keuangan page and filter")
    void testAdminLaporanKeuanganView() {
        loginAsAdmin();

        open("/admin/laporan-keuangan");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/laporan-keuangan"), "Gagal membuka halaman Laporan Keuangan");

        // Cek filter bulan/tahun atau tabel ringkasan
        assertTrue(driver.findElements(By.name("month")).size() > 0 || 
                   driver.findElements(By.name("year")).size() > 0, 
                   "Filter Laporan Keuangan tidak ditemukan");
    }
}

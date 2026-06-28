package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Kenaikan Kelas Test")
public class AdminKenaikanKelasTest extends BaseTest {

    @Test
    @DisplayName("Admin can access kenaikan kelas page and view class filters")
    void testAdminKenaikanKelasView() {
        loginAsAdmin();

        open("/admin/kenaikan-kelas");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/kenaikan-kelas"), "Gagal membuka halaman Kenaikan Kelas");

        // Cek filter atau tabel
        assertTrue(driver.findElements(By.name("from_class_id")).size() > 0 || 
                   driver.findElements(By.cssSelector("table")).size() > 0, 
                   "Filter kelas asal tidak ditemukan di halaman");
    }
}

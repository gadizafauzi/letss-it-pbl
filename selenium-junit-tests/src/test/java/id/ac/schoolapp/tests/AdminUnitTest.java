package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Unit Test")
public class AdminUnitTest extends BaseTest {

    @Test
    @DisplayName("Admin can view unit page")
    void testAdminUnitView() {
        loginAsAdmin();

        open("/admin/unit");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/unit"), "Gagal membuka halaman Unit");

        // Cek adanya tabel unit
        assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel unit tidak ditemukan");
    }
}

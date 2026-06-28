package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - CMS Kontak Test")
public class AdminCmsKontakTest extends BaseTest {

    @Test
    @DisplayName("Admin can view cms kontak page")
    void testAdminCmsKontakView() {
        loginAsAdmin();

        open("/admin/cms/kontak");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/cms/kontak"), "Gagal membuka halaman CMS Kontak");

        // Cek adanya form input email, telepon, dll
        assertTrue(driver.findElements(By.name("email")).size() > 0, "Form kontak tidak ditemukan");
    }
}

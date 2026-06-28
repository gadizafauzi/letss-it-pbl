package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - CMS Unit Test")
public class AdminCmsUnitTest extends BaseTest {

    @Test
    @DisplayName("Admin can view cms unit page")
    void testAdminCmsUnitView() {
        loginAsAdmin();

        open("/admin/unit-cms");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/unit-cms"), "Gagal membuka halaman CMS Unit");

        // Cek apakah list unit (TK, SD, SMP) muncul
        assertTrue(driver.findElements(By.cssSelector(".card")).size() > 0 || 
                   driver.findElements(By.cssSelector("a[href*='/admin/unit-cms/']")).size() > 0, 
                   "Daftar unit tidak ditemukan di CMS Unit");
    }
}

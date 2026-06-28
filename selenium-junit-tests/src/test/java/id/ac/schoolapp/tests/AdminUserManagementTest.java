package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminUserManagementTest extends BaseTest {

    @Test
    void adminCanAccessUserAndRoleManagement() {
        loginAsAdmin();
        open("/admin/users"); // Atau /admin/pengguna jika sistem memiliki multi-user admin/staff

        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();
        
        // Memastikan halaman berhasil dibuka tanpa crash
        assertTrue(driver.getCurrentUrl().contains("/admin") && !driver.getPageSource().isEmpty());
    }
}
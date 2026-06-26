package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminAuthTest extends BaseTest {

    @Test
    void adminCanLoginWithValidAccount() {
        loginAsAdmin();

        assertPageDoesNotShowServerError();
        assertTrue(driver.getCurrentUrl().contains("/admin/dashboard"));
    }

    @Test
    void adminCannotLoginWithWrongPassword() {
        open("/admin/login");

        waitVisible(By.id("admin_login")).sendKeys(ADMIN_USERNAME);
        driver.findElement(By.id("admin_password")).sendKeys("password-salah");
        driver.findElement(By.id("adminBtn")).click();

        wait.until(ExpectedConditions.or(
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-error")),
                ExpectedConditions.urlContains("/admin/login")
        ));

        assertTrue(
                driver.getCurrentUrl().contains("/admin/login")
                        || driver.getPageSource().toLowerCase().contains("login gagal"),
                "Login salah seharusnya ditolak."
        );
    }

    @Test
    void guestCannotOpenAdminDashboardDirectly() {
        open("/admin/dashboard");

        wait.until(ExpectedConditions.or(
                ExpectedConditions.urlContains("/login"),
                ExpectedConditions.urlContains("/admin/login")
        ));

        assertTrue(
                driver.getCurrentUrl().contains("/login")
                        || driver.getCurrentUrl().contains("/admin/login"),
                "Guest seharusnya diarahkan ke halaman login."
        );
    }
}

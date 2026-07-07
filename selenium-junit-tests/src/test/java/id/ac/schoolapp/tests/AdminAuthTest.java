package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Auth Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminAuthTest extends BaseTest {

    @Test
    @Order(1)
    @DisplayName("Admin cannot login with empty fields")
    void adminLoginShouldRejectEmptyFields() {
        open("/admin/login");

        waitVisible(By.id("adminBtn")).click();
        assertPageDoesNotShowServerError();
        
        assertTrue(
                driver.getCurrentUrl().contains("/admin/login"),
                "Sistem meloloskan form login kosong!"
        );
    }

    @Test
    @Order(2)
    @DisplayName("Admin cannot login with invalid user")
    void adminLoginShouldRejectCompletelyInvalidUser() {
        open("/admin/login");

        waitVisible(By.id("admin_login")).sendKeys("user_palsu_123");
        driver.findElement(By.id("admin_password")).sendKeys("SembarangPassword");
        driver.findElement(By.id("adminBtn")).click();

        wait.until(ExpectedConditions.or(
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-danger")),
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-error")),
                ExpectedConditions.urlContains("/admin/login")
        ));

        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getCurrentUrl().contains("/admin/login") 
                || driver.getPageSource().toLowerCase().contains("gagal"),
                "Sistem meloloskan user tidak valid!"
        );
    }

    @Test
    @Order(3)
    @DisplayName("Admin cannot login with wrong password")
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
    @Order(4)
    @DisplayName("Guest cannot open admin dashboard directly")
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

    @Test
    @Order(5)
    @DisplayName("Admin can login with valid account")
    void adminCanLoginWithValidAccount() {
        open("/admin/login");

        waitVisible(By.id("admin_login")).sendKeys(ADMIN_USERNAME);
        driver.findElement(By.id("admin_password")).sendKeys(ADMIN_PASSWORD);
        try {
            driver.findElement(By.id("captcha")).sendKeys("1234");
        } catch (Exception e) {}
        jsClick(driver.findElement(By.id("adminBtn")));
        
        wait.until(ExpectedConditions.urlContains("/admin/dashboard"));
        assertPageDoesNotShowServerError();
        assertTrue(driver.getCurrentUrl().contains("/admin/dashboard"));
    }

    @Test
    @Order(6)
    @DisplayName("Admin can logout successfully")
    void adminCanLogoutSuccessfully() {
        try {
            ((org.openqa.selenium.JavascriptExecutor) driver).executeScript(
                "const form = document.createElement('form');" +
                "form.method = 'POST';" +
                "form.action = '/logout';" +
                "const csrf = document.createElement('input');" +
                "csrf.type = 'hidden';" +
                "csrf.name = '_token';" +
                "csrf.value = document.querySelector('meta[name=\"csrf-token\"]').content;" +
                "form.appendChild(csrf);" +
                "document.body.appendChild(form);" +
                "form.submit();"
            );
        } catch (Exception e) {
            e.printStackTrace();
        }

        wait.until(ExpectedConditions.or(
                ExpectedConditions.urlContains("/admin/login"),
                ExpectedConditions.urlContains("/login")
        ));

        assertTrue(
                driver.getCurrentUrl().contains("login"),
                "Admin gagal melakukan logout."
        );
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Teacher - Authentication Test")
public class TeacherAuthTest extends BaseTest {

    @Test
    @DisplayName("Teacher can login with valid NIP")
    void testTeacherLoginSuccess() {
        // Asumsi ada NIP 1987654321 dari UserSeeder
        loginAsTeacher("1987654321", "12345678");

        // Verify we are on teacher dashboard
        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/teacher/"), "Gagal login sebagai Teacher");
        assertPageDoesNotShowServerError();
        
        // Cek elemen dashboard untuk guru
        assertTrue(driver.findElements(By.cssSelector(".dashboard-card")).size() > 0, "Dashboard teacher tidak memuat card");
    }

    @Test
    @DisplayName("Teacher cannot login with invalid credentials")
    void testTeacherLoginInvalid() {
        open("/login");
        waitVisible(By.id("tab-teacher")).click();
        waitVisible(By.id("login")).sendKeys("1111111111"); // Invalid NIP
        driver.findElement(By.id("password")).sendKeys("wrongpassword");
        driver.findElement(By.id("loginBtn")).click();

        // Harusnya tetap di halaman login atau menunjukkan error
        waitVisible(By.cssSelector(".alert-error"));
        assertTrue(driver.getCurrentUrl().contains("/login"), "Seharusnya tidak redirect");
    }
}

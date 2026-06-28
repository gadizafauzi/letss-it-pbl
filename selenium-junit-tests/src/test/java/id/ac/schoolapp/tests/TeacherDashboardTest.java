package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Teacher - Dashboard Test")
public class TeacherDashboardTest extends BaseTest {

    @Test
    @DisplayName("Teacher can view dashboard and navigate to profile")
    void testTeacherDashboardAndProfile() {
        loginAsTeacher("1987654321", "12345678");

        assertPageDoesNotShowServerError();

        // Navigate to Profil
        waitVisible(By.cssSelector("a[href*='/teacher/profil']")).click();
        assertPageDoesNotShowServerError();

        assertTrue(driver.getCurrentUrl().contains("/teacher/profil"), "Gagal navigasi ke profil guru");
        
        // Cek update profile form
        assertTrue(driver.findElements(By.name("phone")).size() > 0, "Form profil guru tidak ditemukan");
    }
}

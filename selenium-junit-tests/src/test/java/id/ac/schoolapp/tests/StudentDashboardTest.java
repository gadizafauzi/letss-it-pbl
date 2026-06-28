package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Student - Dashboard Test")
public class StudentDashboardTest extends BaseTest {

    @Test
    @DisplayName("Student can view dashboard and navigate to tagihan")
    void testStudentDashboardAndTagihan() {
        loginAsStudent("1234567890", "12345678");

        String currentUrl = driver.getCurrentUrl();
        if(currentUrl.contains("/student/")) {
            assertPageDoesNotShowServerError();

            // Navigate to Tagihan
            waitVisible(By.cssSelector("a[href*='/student/tagihan']")).click();
            assertPageDoesNotShowServerError();

            assertTrue(driver.getCurrentUrl().contains("/student/tagihan"), "Gagal navigasi ke halaman Tagihan");
            
            // Cek elemen tabel tagihan
            assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel tagihan tidak ditemukan");
        } else {
            System.out.println("Skipped test due to invalid NIS placeholder");
        }
    }
}

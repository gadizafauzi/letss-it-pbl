package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Teacher - Input Nilai Test")
public class TeacherInputNilaiTest extends BaseTest {

    @Test
    @DisplayName("Teacher can access kelas saya and view students")
    void testTeacherViewKelasSaya() {
        loginAsTeacher("1987654321", "12345678");

        assertPageDoesNotShowServerError();

        // Navigate to Kelas Saya
        waitVisible(By.cssSelector("a[href*='/teacher/kelas-saya']")).click();
        assertPageDoesNotShowServerError();

        assertTrue(driver.getCurrentUrl().contains("/teacher/kelas-saya"), "Gagal navigasi ke Kelas Saya");
        
        // Asumsi ada tabel atau list kelas
        assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel kelas tidak ditemukan");
    }
}

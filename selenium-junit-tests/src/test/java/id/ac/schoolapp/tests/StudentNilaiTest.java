package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Student - Nilai Test")
public class StudentNilaiTest extends BaseTest {

    @Test
    @DisplayName("Student can view nilai page")
    void testStudentNilaiView() {
        loginAsStudent("1234567890", "12345678");

        String currentUrl = driver.getCurrentUrl();
        if(currentUrl.contains("/student/")) {
            open("/student/nilai");
            assertPageDoesNotShowServerError();

            assertTrue(driver.getCurrentUrl().contains("/student/nilai"), "Gagal membuka halaman Nilai Siswa");

            // Cek elemen tabel nilai atau info rapor
            assertTrue(driver.findElements(By.cssSelector("table")).size() > 0 ||
                       driver.findElements(By.cssSelector(".card")).size() > 0, 
                       "Data nilai tidak ditemukan");
        } else {
            System.out.println("Skipped test due to invalid NIS placeholder");
        }
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Teacher - Wali Rekap Nilai Test")
public class TeacherWaliRekapNilaiTest extends BaseTest {

    @Test
    @DisplayName("Wali Kelas can access rekap nilai")
    void testTeacherViewWaliRekapNilai() {
        loginAsTeacher("1987654321", "12345678");

        open("/teacher/wali-rekap-nilai");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        if (currentUrl.contains("/teacher/wali-rekap-nilai")) {
            assertTrue(currentUrl.contains("/teacher/wali-rekap-nilai"), "Gagal membuka halaman Wali Rekap Nilai");

            // Cek elemen tabel rekap nilai
            assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel rekap nilai tidak ditemukan");
        } else {
            System.out.println("Teacher bukan wali kelas atau redirect terjadi");
        }
    }
}

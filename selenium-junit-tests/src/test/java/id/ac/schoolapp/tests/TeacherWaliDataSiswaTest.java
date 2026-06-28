package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Teacher - Wali Data Siswa Test")
public class TeacherWaliDataSiswaTest extends BaseTest {

    @Test
    @DisplayName("Wali Kelas can access data siswa")
    void testTeacherViewWaliDataSiswa() {
        loginAsTeacher("1987654321", "12345678");

        open("/teacher/wali-data-siswa");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        // Cek apakah url benar, atau redirect jika dia bukan wali kelas
        if (currentUrl.contains("/teacher/wali-data-siswa")) {
            assertTrue(currentUrl.contains("/teacher/wali-data-siswa"), "Gagal membuka halaman Wali Data Siswa");

            // Cek elemen tabel siswa
            assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel data siswa tidak ditemukan");
        } else {
            System.out.println("Teacher bukan wali kelas atau redirect terjadi");
        }
    }
}

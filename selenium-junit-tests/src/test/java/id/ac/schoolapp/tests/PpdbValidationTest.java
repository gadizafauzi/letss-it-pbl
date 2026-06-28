package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import static org.junit.jupiter.api.Assertions.assertTrue;

class PpdbValidationTest extends BaseTest {

    @Test
    void ppdbFormShouldShowValidationErrorWhenFieldsAreEmpty() {
        // 1. Buka form registrasi PPDB publik
        open("/ppdb");

        // 2. Sengaja langsung klik submit tanpa mengisi form apapun (Menguji Validasi)
        waitVisible(By.cssSelector("button[type='submit']")).click();

        // 3. Sistem harus menolak dan memicu alert bawaan Laravel / HTML5 validation
        // Di sini kita cek apakah halaman mendeteksi pesan error atau tetap berada di halaman form yang sama
        assertPageDoesNotShowServerError();
        
        // Memastikan URL tidak berpindah ke halaman sukses/dashboard
        assertTrue(
                driver.getCurrentUrl().contains("/ppdb"),
                "Form kosong meloloskan pendaftaran! Seharusnya tetap berada di halaman registrasi."
        );
    }
}
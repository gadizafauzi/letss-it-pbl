package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Rekening Sekolah Test")
public class AdminRekeningSekolahTest extends BaseTest {

    @Test
    @DisplayName("Admin can view rekening sekolah page")
    void testAdminRekeningSekolahView() {
        loginAsAdmin();

        open("/admin/rekening-sekolah");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/rekening-sekolah"), "Gagal membuka halaman Rekening Sekolah");

        // Cek tombol tambah atau tabel
        assertTrue(driver.findElements(By.cssSelector(".btn-primary")).size() > 0 ||
                   driver.findElements(By.cssSelector("table")).size() > 0, 
                   "Elemen rekening sekolah tidak ditemukan");
    }
}

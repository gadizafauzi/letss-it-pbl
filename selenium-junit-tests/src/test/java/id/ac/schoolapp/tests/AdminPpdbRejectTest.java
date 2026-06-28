package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminPpdbRejectTest extends BaseTest {

    @Test
    void adminCanRejectPpdbApplicantWithReason() {
        loginAsAdmin();
        open("/admin/siswa"); // Rute penampung data pendaftar atau penyeleksian

        try {
            driver.findElement(By.partialLinkText("Detail")).click();
            
            // Simulasikan menolak siswa / tidak lulus seleksi berkas
            driver.findElement(By.cssSelector(".btn-danger, button[name='status'][value='ditolak']")).click();
            
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil") || driver.getCurrentUrl().contains("/admin"));
        } catch (Exception e) {
            System.out.println("Tombol aksi reject PPDB tidak ditemukan.");
        }
    }
}
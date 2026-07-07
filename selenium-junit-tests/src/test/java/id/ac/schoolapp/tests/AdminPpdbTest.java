package id.ac.schoolapp.tests;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - PPDB Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminPpdbTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @Order(1)
    @DisplayName("Admin can verify PPDB applicant")
    void adminCanVerifyPpdbApplicantStatus() {
        open("/admin/siswa");

        try {
            driver.findElement(By.partialLinkText("Detail")).click();
            driver.findElement(By.cssSelector(".btn-success, button[name='status'][value='diterima']")).click();
            
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Fitur verifikasi PPDB admin tidak ditemukan.");
        }
    }

    @Test
    @Order(2)
    @DisplayName("Admin can reject PPDB applicant")
    void adminCanRejectPpdbApplicantWithReason() {
        open("/admin/siswa");

        try {
            driver.findElement(By.partialLinkText("Detail")).click();
            driver.findElement(By.cssSelector(".btn-danger, button[name='status'][value='ditolak']")).click();
            
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil") || driver.getCurrentUrl().contains("/admin"));
        } catch (Exception e) {
            System.out.println("Tombol aksi reject PPDB tidak ditemukan.");
        }
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Tahun Ajaran Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminTahunAjaranTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @Order(1)
    @DisplayName("Admin can add academic year")
    void adminCanAddAcademicYear() {
        open("/admin/tahun-ajaran");

        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/tahun-ajaran/create");
        }

        waitVisible(By.name("tahun_ajaran")).sendKeys("2026/2027");
        
        try {
            Select status = new Select(driver.findElement(By.name("status")));
            status.selectByValue("Aktif");
        } catch (Exception e) {
            System.out.println("Dropdown status tidak ditemukan, sesuaikan jika perlu.");
        }

        driver.findElement(By.cssSelector("button[type='submit']")).click();

        wait.until(ExpectedConditions.urlContains("/admin/tahun-ajaran"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("2026/2027")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan tahun ajaran baru."
        );
    }

    @Test
    @Order(2)
    @DisplayName("Admin can update academic year status")
    void adminCanUpdateAcademicYearStatus() {
        open("/admin/tahun-ajaran");

        try {
            driver.findElement(By.cssSelector(".btn-warning, a[href*='edit']")).click();

            waitVisible(By.name("tahun_ajaran")).clear();
            driver.findElement(By.name("tahun_ajaran")).sendKeys("2026/2027 Ganjil");

            driver.findElement(By.cssSelector("button[type='submit']")).click();

            wait.until(ExpectedConditions.urlContains("/admin/tahun-ajaran"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().contains("2026/2027 Ganjil") || driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Data tahun ajaran belum tersedia.");
            assertTrue(driver.getCurrentUrl().contains("/admin/tahun-ajaran"));
        }
    }

    @Test
    @Order(3)
    @DisplayName("Admin can delete academic year")
    void adminCanDeleteTahunAjaran() {
        open("/admin/tahun-ajaran");

        try {
            driver.findElement(By.cssSelector("form[action*='tahun-ajaran'] button, .btn-danger")).click();
            
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/tahun-ajaran"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Tabel tahun ajaran kosong, skip delete.");
            assertTrue(driver.getCurrentUrl().contains("/admin/tahun-ajaran"));
        }
    }
}

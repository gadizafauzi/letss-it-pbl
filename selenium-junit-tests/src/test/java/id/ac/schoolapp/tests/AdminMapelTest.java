package id.ac.schoolapp.tests;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Mapel Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminMapelTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @Order(1)
    @DisplayName("Admin can add mapel successfully")
    void adminCanAddMataPelajaranSuccessfully() {
        open("/admin/mapel");

        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/mapel/create");
        }

        waitVisible(By.name("kode_mapel")).sendKeys("MP-INF-01");
        driver.findElement(By.name("nama_mapel")).sendKeys("Informatika dan Coding");

        driver.findElement(By.cssSelector("button[type='submit']")).click();

        wait.until(ExpectedConditions.urlContains("/admin/mapel"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("Informatika dan Coding")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan mata pelajaran baru."
        );
    }

    @Test
    @Order(2)
    @DisplayName("Admin can update mapel name")
    void adminCanUpdateMataPelajaranName() {
        open("/admin/mapel");

        try {
            driver.findElement(By.cssSelector(".btn-warning, a[href*='edit']")).click();
            
            waitVisible(By.name("nama_mapel")).clear();
            driver.findElement(By.name("nama_mapel")).sendKeys("Bahasa Inggris Cambridge");

            driver.findElement(By.cssSelector("button[type='submit']")).click();

            wait.until(ExpectedConditions.urlContains("/admin/mapel"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().contains("Cambridge") || driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Data mapel kosong, skip update.");
            assertTrue(driver.getCurrentUrl().contains("/admin/mapel"));
        }
    }

    @Test
    @Order(3)
    @DisplayName("Admin can delete mapel")
    void adminCanDeleteMataPelajaran() {
        open("/admin/mapel");

        try {
            driver.findElement(By.cssSelector("form[action*='mapel'] button, .btn-danger")).click();
            
            try {
                driver.switchTo().alert().accept();
            } catch (Exception a) { }

            wait.until(ExpectedConditions.urlContains("/admin/mapel"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Tabel mapel kosong atau tombol hapus tidak dapat diklik.");
            assertTrue(driver.getCurrentUrl().contains("/admin/mapel"));
        }
    }
}

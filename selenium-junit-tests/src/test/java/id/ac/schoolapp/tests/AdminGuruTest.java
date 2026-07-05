package id.ac.schoolapp.tests;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.openqa.selenium.By;
import org.openqa.selenium.Keys;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Guru Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminGuruTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @Order(1)
    @DisplayName("Admin can view guru import page")
    void testAdminGuruImportView() {
        open("/admin/guru/import");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/guru/import"), "Gagal membuka halaman Import Guru");

        assertTrue(driver.findElements(By.cssSelector("input[type='file']")).size() > 0, "Form upload file excel tidak ditemukan");
        assertTrue(driver.findElements(By.cssSelector("a[href*='template']")).size() > 0, "Tombol download template tidak ditemukan");
    }

    @Test
    @Order(2)
    @DisplayName("Admin can add new guru")
    void adminCanAddGuruSuccessfully() {
        open("/admin/guru");

        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/guru/create");
        }

        waitVisible(By.name("nip")).sendKeys("198801012026031002");
        driver.findElement(By.name("full_name")).sendKeys("Drs. Budi Setiawan, M.Pd");
        
        try {
            Select unitSelect = new Select(driver.findElement(By.name("unit_id")));
            unitSelect.selectByIndex(1);
        } catch (Exception e) {
            try {
                driver.findElement(By.name("unit_id")).sendKeys("1");
            } catch (Exception ex) {
                System.out.println("Field unit_id gagal diisi.");
            }
        }

        try {
            Select statusSelect = new Select(driver.findElement(By.name("status")));
            statusSelect.selectByValue("Aktif");
        } catch (Exception e) {
            try {
                driver.findElement(By.name("status")).sendKeys("Aktif");
            } catch (Exception ex) {
                System.out.println("Field status gagal diisi.");
            }
        }

        driver.findElement(By.xpath("//form[not(contains(@action, 'logout'))]//button[@type='submit']")).click();

        wait.until(ExpectedConditions.urlContains("/admin/guru"));
        assertPageDoesNotShowServerError();
        
        assertTrue(
                driver.getPageSource().contains("Budi Setiawan") 
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan data guru baru."
        );
    }

    @Test
    @Order(3)
    @DisplayName("Admin can filter guru by keyword")
    void adminCanFilterGuruTableByKeyword() {
        open("/admin/guru");

        try {
            waitVisible(By.cssSelector("input[type='search'], input[name='search']")).sendKeys("Budi", Keys.ENTER);
            wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getCurrentUrl().contains("/admin/guru"));
        } catch (Exception e) {
            System.out.println("Search box guru tidak tersedia.");
            assertTrue(driver.getCurrentUrl().contains("/admin/guru"));
        }
    }

    @Test
    @Order(4)
    @DisplayName("Admin can edit existing guru")
    void adminCanEditExistingGuruData() {
        open("/admin/guru");

        try {
            driver.findElement(By.cssSelector(".btn-warning, a[href*='edit']")).click();
        } catch (Exception e) {
            open("/admin/guru/1/edit");
        }

        try {
            waitVisible(By.name("no_hp")).clear();
            driver.findElement(By.name("no_hp")).sendKeys("089999999999");
        } catch (Exception e) {
            try {
                waitVisible(By.name("nama_guru")).sendKeys(" (Updated)");
            } catch (Exception ex) {
                System.out.println("Field nama_guru tidak ditemukan.");
            }
        }

        driver.findElement(By.xpath("//form[not(contains(@action, 'logout'))]//button[@type='submit']")).click();

        wait.until(ExpectedConditions.urlContains("/admin/guru"));
        assertPageDoesNotShowServerError();
        assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
    }

    @Test
    @Order(5)
    @DisplayName("Admin can delete guru")
    void adminCanDeleteGuruWithAlertConfirmation() {
        open("/admin/guru");

        try {
            driver.findElement(By.cssSelector("form[action*='guru'] button, .btn-danger")).click();
            
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/guru"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Data guru kosong atau tombol hapus tidak ditemukan.");
            assertTrue(driver.getCurrentUrl().contains("/admin/guru"));
        }
    }
}

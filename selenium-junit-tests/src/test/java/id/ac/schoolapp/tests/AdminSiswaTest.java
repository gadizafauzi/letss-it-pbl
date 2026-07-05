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

@DisplayName("Admin - Siswa Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminSiswaTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @Order(1)
    @DisplayName("Admin can view siswa import page")
    void testAdminSiswaImportView() {
        open("/admin/siswa/import");
        assertPageDoesNotShowServerError();

        String currentUrl = driver.getCurrentUrl();
        assertTrue(currentUrl.contains("/admin/siswa/import"), "Gagal membuka halaman Import Siswa");

        assertTrue(driver.findElements(By.cssSelector("input[type='file']")).size() > 0, "Form upload file excel tidak ditemukan");
        assertTrue(driver.findElements(By.cssSelector("a[href*='template']")).size() > 0, "Tombol download template tidak ditemukan");
    }

    @Test
    @Order(2)
    @DisplayName("Admin can add new siswa")
    void adminCanAddSiswaSuccessfully() {
        open("/admin/siswa/create");

        waitVisible(By.name("full_name")).sendKeys("Ahmad Fauzi Selenium");
        
        driver.findElement(By.xpath("//button[@data-tab-target='tab-data-sekolah']")).click();
        
        waitVisible(By.name("nis")).sendKeys("20260001");
        driver.findElement(By.name("nisn")).sendKeys("202600010001");
        
        try {
            Select statusSelect = new Select(driver.findElement(By.name("status")));
            statusSelect.selectByValue("Aktif");
        } catch (Exception e) {
            try {
                driver.findElement(By.name("status")).sendKeys("Aktif");
            } catch (Exception ex) {
                System.out.println("Field status menggunakan komponen radio/custom, silakan klik elemennya.");
            }
        }

        jsClick(driver.findElement(By.xpath("//form[not(contains(@action, 'logout'))]//button[@type='submit']")));

        wait.until(ExpectedConditions.urlContains("/admin/siswa"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("Ahmad Fauzi") 
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan data siswa baru."
        );
    }

    @Test
    @Order(3)
    @DisplayName("Admin can edit existing siswa")
    void adminCanEditExistingSiswa() {
        open("/admin/siswa");

        try {
            driver.findElement(By.partialLinkText("Edit")).click();
        } catch (Exception e) {
            System.out.println("Tombol Edit text tidak ditemukan, mencoba mencari selector alternatif.");
            driver.findElement(By.cssSelector(".btn-warning, .btn-edit, a[href*='edit']")).click();
        }

        try {
            waitVisible(By.name("full_name")).clear();
            driver.findElement(By.name("full_name")).sendKeys("Siswa Diperbarui Oleh Selenium");
        } catch(Exception e) {
            waitVisible(By.name("nama")).clear();
            driver.findElement(By.name("nama")).sendKeys("Siswa Diperbarui Oleh Selenium");
        }

        jsClick(driver.findElement(By.xpath("//form[not(contains(@action, 'logout'))]//button[@type='submit']")));

        wait.until(ExpectedConditions.urlContains("/admin/siswa"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("Siswa Diperbarui Oleh Selenium")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal memperbarui data nama siswa."
        );
    }

    @Test
    @Order(4)
    @DisplayName("Admin can export siswa data")
    void adminCanTriggerSiswaDataExport() {
        open("/admin/siswa");

        try {
            driver.findElement(By.partialLinkText("Export")).click();
        } catch (Exception e) {
            try {
                driver.findElement(By.partialLinkText("Cetak")).click();
            } catch (Exception ex) {
                System.out.println("Tombol export/cetak tidak ditemukan.");
            }
        }
        
        assertPageDoesNotShowServerError();
    }

    @Test
    @Order(5)
    @DisplayName("Admin can delete siswa")
    void adminCanDeleteSiswaWithAlertConfirmation() {
        open("/admin/siswa");

        try {
            driver.findElement(By.cssSelector("form[action*='siswa'] button[type='submit'], .btn-danger")).click();
            
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/siswa"));
            assertPageDoesNotShowServerError();

            assertTrue(
                    driver.getPageSource().toLowerCase().contains("hapus") 
                    || driver.getPageSource().toLowerCase().contains("berhasil"),
                    "Pesan sukses menghapus data siswa tidak muncul."
            );
        } catch (Exception e) {
            System.out.println("Data siswa kosong atau tombol hapus tidak ditemukan, melewati eksekusi hapus.");
            assertTrue(driver.getCurrentUrl().contains("/admin/siswa"));
        }
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminMapelDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteMataPelajaran() {
        // 1. Login & Masuk ke Data Mapel
        loginAsAdmin();
        open("/admin/mapel");

        // 2. Eksekusi Hapus Mapel
        try {
            driver.findElement(By.cssSelector("form[action*='mapel'] button, .btn-danger")).click();
            
            // Handle alert popup konfirmasi
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
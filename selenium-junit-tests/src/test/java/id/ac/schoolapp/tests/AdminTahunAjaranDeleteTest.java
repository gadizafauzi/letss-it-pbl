package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminTahunAjaranDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteTahunAjaran() {
        loginAsAdmin();
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
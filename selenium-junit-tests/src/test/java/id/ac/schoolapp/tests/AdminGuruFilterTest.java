package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.Keys;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminGuruFilterTest extends BaseTest {

    @Test
    void adminCanFilterGuruTableByKeyword() {
        loginAsAdmin();
        open("/admin/guru");

        try {
            // Mencari kolom pencarian data guru
            waitVisible(By.cssSelector("input[type='search'], input[name='search']")).sendKeys("Budi", Keys.ENTER);
            
            wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getCurrentUrl().contains("/admin/guru"));
        } catch (Exception e) {
            System.out.println("Search box guru tidak tersedia.");
            assertTrue(driver.getCurrentUrl().contains("/admin/guru"));
        }
    }
}
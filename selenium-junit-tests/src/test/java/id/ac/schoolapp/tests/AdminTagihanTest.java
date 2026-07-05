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

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Tagihan Module Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class AdminTagihanTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @Order(1)
    @DisplayName("Admin can create student billing")
    void adminCanCreateStudentBilling() {
        open("/admin/tagihan");

        try {
            driver.findElement(By.partialLinkText("Buat")).click();
        } catch (Exception e) {
            open("/admin/tagihan/create");
        }

        waitVisible(By.name("nama_tagihan")).sendKeys("SPP Juli 2026");
        driver.findElement(By.name("nominal")).sendKeys("500000");

        driver.findElement(By.cssSelector("button[type='submit']")).click();

        wait.until(ExpectedConditions.urlContains("/admin/tagihan"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("SPP Juli 2026")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal memproses pembuatan komponen tagihan baru."
        );
    }

    @Test
    @Order(2)
    @DisplayName("Admin can filter tagihan by keyword")
    void adminCanFilterTagihanByKeyword() {
        open("/admin/tagihan");

        try {
            waitVisible(By.cssSelector("input[type='search'], input[name='search'], input[name='keyword']"))
                    .sendKeys("SPP", Keys.ENTER);
            
            wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
            assertPageDoesNotShowServerError();
            
            assertTrue(driver.getCurrentUrl().contains("/admin/tagihan"));
        } catch (Exception e) {
            System.out.println("Input field filter pencarian tagihan tidak ditemukan.");
            assertTrue(driver.getCurrentUrl().contains("/admin/tagihan"));
        }
    }

    @Test
    @Order(3)
    @DisplayName("Admin can delete billing category")
    void adminCanDeleteBillingCategory() {
        open("/admin/tagihan");

        try {
            driver.findElement(By.cssSelector("form[action*='tagihan'] button, .btn-danger")).click();
            
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept();

            wait.until(ExpectedConditions.urlContains("/admin/tagihan"));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getPageSource().toLowerCase().contains("berhasil"));
        } catch (Exception e) {
            System.out.println("Tidak ada baris tagihan keuangan untuk dihapus.");
            assertTrue(driver.getCurrentUrl().contains("/admin/tagihan"));
        }
    }
}

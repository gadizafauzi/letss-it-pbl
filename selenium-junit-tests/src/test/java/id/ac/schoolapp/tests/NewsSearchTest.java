package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.Keys;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class NewsSearchTest extends BaseTest {

    @Test
    void userCanSearchNews() {
        open("/berita/search");

        waitVisible(By.name("q")).sendKeys("PPDB", Keys.ENTER);
        wait.until(ExpectedConditions.urlContains("/berita/search"));

        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getPageSource().toLowerCase().contains("ppdb")
                        || driver.getPageSource().toLowerCase().contains("tidak dapat menemukan")
                        || driver.getPageSource().toLowerCase().contains("pencarian"),
                "Halaman pencarian tidak menampilkan hasil atau pesan pencarian."
        );
    }
}

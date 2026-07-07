package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Public - PPDB Registration Tests")
public class PpdbTest extends BaseTest {

    @Test
    @DisplayName("Guest can view PPDB information page")
    void guestCanViewPpdbInformationPage() {
        open("/ppdb");
        wait.until(ExpectedConditions.presenceOfElementLocated(By.id("timeline")));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().toLowerCase().contains("pendaftaran"),
                "Halaman PPDB tidak memuat informasi pendaftaran."
        );
    }
}

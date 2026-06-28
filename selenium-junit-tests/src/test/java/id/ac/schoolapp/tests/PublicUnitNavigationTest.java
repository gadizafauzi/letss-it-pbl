package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class PublicUnitNavigationTest extends BaseTest {

    @Test
    void userCanNavigateToAllSchoolUnitsFromHome() {
        // 1. Buka landing page utama publik
        open("/");

        // 2. Klik link navigasi menuju Unit TK, lalu verifikasi halaman tidak error
        driver.findElement(By.partialLinkText("TK")).click();
        wait.until(ExpectedConditions.urlContains("/unit/tk"));
        assertPageDoesNotShowServerError();

        // 3. Kembali ke home dan klik unit SD
        open("/");
        driver.findElement(By.partialLinkText("SD")).click();
        wait.until(ExpectedConditions.urlContains("/unit/sd"));
        assertPageDoesNotShowServerError();

        // 4. Kembali ke home dan klik unit SMP
        open("/");
        driver.findElement(By.partialLinkText("SMP")).click();
        wait.until(ExpectedConditions.urlContains("/unit/smp"));
        assertPageDoesNotShowServerError();
        
        assertTrue(driver.getPageSource().toLowerCase().contains("smp"), "Halaman unit SMP gagal dimuat dengan benar.");
    }
}

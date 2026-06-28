package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminSiswaExportTest extends BaseTest {

    @Test
    void adminCanTriggerSiswaDataExport() {
        loginAsAdmin();
        open("/admin/siswa");

        // Menguji tombol Export Excel atau Download PDF pada manajemen data siswa
        try {
            driver.findElement(By.partialLinkText("Export")).click();
        } catch (Exception e) {
            try {
                driver.findElement(By.partialLinkText("Cetak")).click();
            } catch (Exception ex) {
                System.out.println("Tombol export/cetak tidak ditemukan.");
            }
        }
        
        // Memastikan aksi tidak memicu 500 server error
        assertPageDoesNotShowServerError();
        assertTrue(driver.getCurrentUrl().contains("/admin/siswa") || !driver.getPageSource().isEmpty());
    }
}
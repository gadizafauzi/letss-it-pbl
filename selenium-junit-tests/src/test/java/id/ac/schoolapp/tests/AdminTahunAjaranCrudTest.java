package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminTahunAjaranCrudTest extends BaseTest {

    @Test
    void adminCanAddAcademicYear() {
        // 1. Login & Navigasi ke Tahun Ajaran
        loginAsAdmin();
        open("/admin/tahun-ajaran");

        // 2. Buka Form Tambah
        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/tahun-ajaran/create");
        }

        // 3. Isi Form Tahun Ajaran Baru (Tahun berjalan: 2026)
        waitVisible(By.name("tahun_ajaran")).sendKeys("2026/2027");
        
        try {
            Select status = new Select(driver.findElement(By.name("status")));
            status.selectByValue("Aktif");
        } catch (Exception e) {
            // Jika status berupa checkbox atau radio button
            System.out.println("Dropdown status tidak ditemukan, sesuaikan jika perlu.");
        }

        // Submit
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Validasi Sukses
        wait.until(ExpectedConditions.urlContains("/admin/tahun-ajaran"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("2026/2027")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan tahun ajaran baru."
        );
    }
}
package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminMapelCrudTest extends BaseTest {

    @Test
    void adminCanAddMataPelajaranSuccessfully() {
        // 1. Login & Navigasi ke Menu Mapel
        loginAsAdmin();
        open("/admin/mapel");

        // 2. Klik Tambah Mapel
        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/mapel/create");
        }

        // 3. Isi Form Mata Pelajaran
        waitVisible(By.name("kode_mapel")).sendKeys("MP-INF-01");
        driver.findElement(By.name("nama_mapel")).sendKeys("Informatika dan Coding");

        // Submit
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Verifikasi Data Baru Muncul di Tabel
        wait.until(ExpectedConditions.urlContains("/admin/mapel"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("Informatika dan Coding")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan mata pelajaran baru."
        );
    }
}

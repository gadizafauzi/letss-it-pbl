package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminKelasCrudTest extends BaseTest {

    @Test
    void adminCanCreateNewClassRoom() {
        // 1. Login & Masuk ke Menu Kelas
        loginAsAdmin();
        open("/admin/kelas");

        // 2. Masuk ke Form Tambah Kelas
        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/kelas/create");
        }

        // 3. Isi Nama Kelas dan Atributnya
        waitVisible(By.name("nama_kelas")).sendKeys("Kelas X-A Otomasi");
        
        try {
            // Jika ada field kuota atau wali kelas
            driver.findElement(By.name("kuota")).sendKeys("36");
        } catch (Exception e) {
            // Abaikan jika struktur form berbeda
        }

        // Submit Form
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Verifikasi Data Berhasil Disimpan
        wait.until(ExpectedConditions.urlContains("/admin/kelas"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("X-A Otomasi")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal membuat data kelas baru."
        );
    }
}
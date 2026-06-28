package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminTagihanTest extends BaseTest {

    @Test
    void adminCanCreateStudentBilling() {
        // 1. Login & Masuk ke Menu Tagihan Keuangan Siswa
        loginAsAdmin();
        open("/admin/tagihan");

        // 2. Buka Form Buat Tagihan Baru (Misal: SPP atau Uang Pangkal)
        try {
            driver.findElement(By.partialLinkText("Buat")).click();
        } catch (Exception e) {
            open("/admin/tagihan/create");
        }

        // 3. Isi Detail Komponen Tagihan
        waitVisible(By.name("nama_tagihan")).sendKeys("SPP Juli 2026");
        driver.findElement(By.name("nominal")).sendKeys("500000");

        // Submit Form
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Tunggu Redirect & Cek Notifikasi Sukses
        wait.until(ExpectedConditions.urlContains("/admin/tagihan"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("SPP Juli 2026")
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal memproses pembuatan komponen tagihan baru."
        );
    }
}

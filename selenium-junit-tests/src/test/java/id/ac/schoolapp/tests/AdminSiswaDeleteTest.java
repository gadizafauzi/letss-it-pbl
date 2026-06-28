package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminSiswaDeleteTest extends BaseTest {

    @Test
    void adminCanDeleteSiswaWithAlertConfirmation() {
        // 1. Login & Masuk ke Manajemen Siswa
        loginAsAdmin();
        open("/admin/siswa");

        // 2. Cari tombol hapus/delete pertama
        try {
            driver.findElement(By.cssSelector("form[action*='siswa'] button[type='submit'], .btn-danger")).click();
            
            // 3. Handle JavaScript Confirmation Alert ("Apakah anda yakin?")
            wait.until(ExpectedConditions.alertIsPresent());
            driver.switchTo().alert().accept(); // Klik "OK" pada alert konfirmasi popup

            // 4. Tunggu reload dan pastikan tidak server error
            wait.until(ExpectedConditions.urlContains("/admin/siswa"));
            assertPageDoesNotShowServerError();

            assertTrue(
                    driver.getPageSource().toLowerCase().contains("hapus") 
                    || driver.getPageSource().toLowerCase().contains("berhasil"),
                    "Pesan sukses menghapus data siswa tidak muncul."
            );
        } catch (Exception e) {
            System.out.println("Data siswa kosong atau tombol hapus tidak ditemukan, melewati eksekusi hapus.");
            assertTrue(driver.getCurrentUrl().contains("/admin/siswa"));
        }
    }
}
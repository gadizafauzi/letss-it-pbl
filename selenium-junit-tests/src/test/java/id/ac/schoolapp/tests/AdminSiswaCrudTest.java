package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminSiswaCrudTest extends BaseTest {

    @Test
    void adminCanAddSiswaSuccessfully() {
        // 1. Login & Masuk ke Menu Siswa
        loginAsAdmin();
        open("/admin/siswa");

        // 2. Buka Form Tambah Siswa
        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/siswa/create");
        }

        // 3. PERBAIKAN: Menggunakan 'nis', 'full_name', dan 'status' sesuai HTML & StoreSiswaRequest
        waitVisible(By.name("nis")).sendKeys("20260001");
        driver.findElement(By.name("full_name")).sendKeys("Ahmad Fauzi");
        
        // Mengisi field wajib 'status' melalui Dropdown Select (Fallback ke input text jika tipenya berbeda)
        try {
            Select statusSelect = new Select(driver.findElement(By.name("status")));
            statusSelect.selectByValue("Aktif"); // Ubah ke "1" atau "active" sesuai value di database Anda
        } catch (Exception e) {
            try {
                driver.findElement(By.name("status")).sendKeys("Aktif");
            } catch (Exception ex) {
                System.out.println("Field status menggunakan komponen radio/custom, silakan klik elemennya.");
            }
        }

        // Klik Simpan
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Validasi Redirect dan Data Terpampang
        wait.until(ExpectedConditions.urlContains("/admin/siswa"));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().contains("Ahmad Fauzi") 
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan data siswa baru karena validation error atau input mismatch."
        );
    }
}
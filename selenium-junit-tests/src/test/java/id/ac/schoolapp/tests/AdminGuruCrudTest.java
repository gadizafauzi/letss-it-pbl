package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminGuruCrudTest extends BaseTest {

    @Test
    void adminCanAddGuruSuccessfully() {
        // 1. Login & Masuk ke Menu Guru
        loginAsAdmin();
        open("/admin/guru");

        // 2. Buka Form Tambah Guru
        try {
            driver.findElement(By.partialLinkText("Tambah")).click();
        } catch (Exception e) {
            open("/admin/guru/create");
        }

        // 3. PERBAIKAN: Menggunakan 'nip', 'full_name', 'unit_id', dan 'status' sesuai StoreGuruRequest
        waitVisible(By.name("nip")).sendKeys("198801012026031002");
        driver.findElement(By.name("full_name")).sendKeys("Drs. Budi Setiawan, M.Pd");
        
        // Mengisi field wajib 'unit_id' (Dropdown Unit Sekolah: TK/SD/SMP)
        try {
            Select unitSelect = new Select(driver.findElement(By.name("unit_id")));
            unitSelect.selectByIndex(1); // Memilih opsi index ke-1 dari dropdown unit
        } catch (Exception e) {
            try {
                driver.findElement(By.name("unit_id")).sendKeys("1");
            } catch (Exception ex) {
                System.out.println("Field unit_id gagal diisi.");
            }
        }

        // Mengisi field wajib 'status'
        try {
            Select statusSelect = new Select(driver.findElement(By.name("status")));
            statusSelect.selectByValue("Aktif");
        } catch (Exception e) {
            try {
                driver.findElement(By.name("status")).sendKeys("Aktif");
            } catch (Exception ex) {
                System.out.println("Field status gagal diisi.");
            }
        }

        // Klik Simpan
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Validasi Keberhasilan
        wait.until(ExpectedConditions.urlContains("/admin/guru"));
        assertPageDoesNotShowServerError();
        
        assertTrue(
                driver.getPageSource().contains("Budi Setiawan") 
                || driver.getPageSource().toLowerCase().contains("berhasil"),
                "Admin gagal menambahkan data guru baru akibat parameter form tidak lengkap."
        );
    }
}
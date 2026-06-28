package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminCmsProfilTest extends BaseTest {

    @Test
    void adminCanUpdateSchoolProfileInfo() {
        // 1. Login & Masuk ke CMS Profil Sekolah
        loginAsAdmin();
        open("/admin/cms/profil");

        // 2. Ubah data profil institusi (Misal: Visi, Misi, atau Deskripsi Sejarah)
        try {
            waitVisible(By.name("visi")).clear();
            driver.findElement(By.name("visi")).sendKeys("Menjadi Sekolah IT Unggul, Cerdas, dan Berakhlak Mulia.");
            
            driver.findElement(By.name("misi")).clear();
            driver.findElement(By.name("misi")).sendKeys("Menyelenggarakan pendidikan berbasis IPTEK dan IMTAK secara terpadu.");
        } catch (Exception e) {
            // Fallback jika menggunakan field deskripsi umum
            waitVisible(By.name("deskripsi")).clear();
            driver.findElement(By.name("deskripsi")).sendKeys("Pembaruan profil sekolah lewat automation testing.");
        }

        // 3. Simpan Perubahan CMS
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Verifikasi status pembaruan konten
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();

        assertTrue(
                driver.getPageSource().toLowerCase().contains("berhasil")
                || driver.getPageSource().toLowerCase().contains("diperbarui")
                || driver.getPageSource().toLowerCase().contains("sukses"),
                "Admin gagal memperbarui data CMS Profil sekolah."
        );
    }
}
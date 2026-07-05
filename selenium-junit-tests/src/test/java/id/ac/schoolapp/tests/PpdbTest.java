package id.ac.schoolapp.tests;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Public - PPDB Registration Tests")
public class PpdbTest extends BaseTest {

    @Test
    @DisplayName("PPDB Form should show validation error when fields are empty")
    void ppdbFormShouldShowValidationErrorWhenFieldsAreEmpty() {
        open("/ppdb");

        waitVisible(By.cssSelector("button[type='submit']")).click();

        assertPageDoesNotShowServerError();
        
        assertTrue(
                driver.getCurrentUrl().contains("/ppdb"),
                "Form kosong meloloskan pendaftaran! Seharusnya tetap berada di halaman registrasi."
        );
    }

    @Test
    @DisplayName("Guest can register PPDB successfully")
    void guestUserCanRegisterPpdbSuccessfully() {
        open("/ppdb");

        waitVisible(By.name("nama_lengkap")).sendKeys("Calon Siswa Baru Selenium");
        driver.findElement(By.name("nisn")).sendKeys("0012345678");
        driver.findElement(By.name("tempat_lahir")).sendKeys("Batam");
        driver.findElement(By.name("tanggal_lahir")).sendKeys("15-08-2010");
        
        try {
            driver.findElement(By.name("jenis_kelamin")).sendKeys("Laki-laki");
        } catch (Exception e) {
            System.out.println("Dropdown atau radio jenis kelamin dilewati, mencoba dengan cara berbeda jika error.");
        }

        driver.findElement(By.name("nama_ayah")).sendKeys("Bapak Selenium");
        driver.findElement(By.name("no_hp_ortu")).sendKeys("081111111111");

        try {
            driver.findElement(By.name("asal_sekolah")).sendKeys("SDIT Selenium");
        } catch(Exception e) {}

        driver.findElement(By.cssSelector("button[type='submit']")).click();

        wait.until(ExpectedConditions.or(
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-success")),
                ExpectedConditions.urlContains("/ppdb/sukses"),
                ExpectedConditions.urlContains("/ppdb")
        ));

        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getPageSource().toLowerCase().contains("berhasil") 
                || driver.getCurrentUrl().contains("sukses")
                || driver.getPageSource().toLowerCase().contains("terima kasih")
                || driver.getPageSource().toLowerCase().contains("alert-success"),
                "Pendaftaran PPDB oleh publik gagal atau tidak menampilkan pesan sukses."
        );
    }
}

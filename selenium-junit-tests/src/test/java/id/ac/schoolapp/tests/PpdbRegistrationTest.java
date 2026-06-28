package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;

import static org.junit.jupiter.api.Assertions.assertTrue;

class PpdbRegistrationTest extends BaseTest {

    @Test
    void publicUserCanRegisterPPDB() {
        // 1. Buka halaman registrasi PPDB publik
        open("/ppdb");

        // 2. Isi Formulir Pendaftaran PPDB
        waitVisible(By.name("nama_lengkap")).sendKeys("Ahmad Fauzi");
        driver.findElement(By.name("nisn")).sendKeys("1234567890");
        driver.findElement(By.name("tempat_lahir")).sendKeys("Padang");
        driver.findElement(By.name("tanggal_lahir")).sendKeys("12-12-2010");
        
        // Memilih Jenis Kelamin dari elemen <select> dropdown
        try {
            Select jenisKelamin = new Select(driver.findElement(By.name("jenis_kelamin")));
            jenisKelamin.selectByValue("Laki-laki");
        } catch (Exception e) {
            // Fallback jika menggunakan input text biasa atau radio button
            System.out.println("Dropdown jenis_kelamin tidak ditemukan, melewati atau sesuaikan.");
        }

        driver.findElement(By.name("email")).sendKeys("ahmad.fauzi@example.com");
        driver.findElement(By.name("no_hp")).sendKeys("081234567890");
        driver.findElement(By.name("alamat")).sendKeys("Jl. Khatib Sulaiman No. 20, Padang");

        // 3. Klik Tombol Kirim / Daftar
        // Mencari tombol submit form
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        // 4. Tunggu respons sistem (Bisa berupa alert sukses atau pengalihan URL)
        wait.until(ExpectedConditions.or(
                ExpectedConditions.visibilityOfElementLocated(By.className("alert-success")),
                ExpectedConditions.urlContains("/ppdb/sukses"),
                ExpectedConditions.urlContains("/ppdb")
        ));

        // 5. Validasi bahwa tidak ada server error dan data berhasil diproses
        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getPageSource().toLowerCase().contains("berhasil") 
                || driver.getCurrentUrl().contains("sukses")
                || driver.getPageSource().toLowerCase().contains("terima kasih"),
                "Pendaftaran PPDB oleh publik gagal atau tidak menampilkan pesan sukses."
        );
    }
}
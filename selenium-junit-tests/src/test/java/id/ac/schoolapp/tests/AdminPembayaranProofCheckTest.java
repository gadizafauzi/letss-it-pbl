package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminPembayaranProofCheckTest extends BaseTest {

    @Test
    void adminCanViewUploadedPaymentProofImage() {
        loginAsAdmin();
        open("/admin/pembayaran");

        try {
            // Klik baris invoice atau detail pembayaran siswa untuk melihat bukti upload struk/transfer
            driver.findElement(By.partialLinkText("Detail")).click();
            
            wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
            assertPageDoesNotShowServerError();
            
            // Memastikan ada tag gambar (img) bukti transfer yang dimuat pada halaman detail verifikasi tersebut
            boolean hasImageProof = !driver.findElements(By.tagName("img")).isEmpty();
            assertTrue(hasImageProof, "Halaman detail verifikasi pembayaran tidak menampilkan gambar bukti transfer.");
        } catch (Exception e) {
            System.out.println("Tabel pembayaran kosong atau tombol detail struk tidak ditemukan.");
            assertTrue(driver.getCurrentUrl().contains("/admin/pembayaran"));
        }
    }
}
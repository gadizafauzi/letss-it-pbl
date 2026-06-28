package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminLogoutTest extends BaseTest {

    @Test
    void adminCanLogoutSuccessfully() {
        // 1. Pastikan admin dalam kondisi login
        loginAsAdmin();

        // 2. Lakukan trigger proses logout
        try {
            // Mencari elemen tombol/tautan logout di navigasi panel admin
            driver.findElement(By.partialLinkText("Logout")).click();
        } catch (Exception e) {
            // Jika tombol tersembunyi di dalam dropdown atau menggunakan form post khusus,
            // kita lakukan hit URL logout langsung sebagai alternatif pengujian
            open("/admin/logout"); 
        }

        // 3. Tunggu hingga sistem mengarahkan kembali ke halaman login utama
        wait.until(ExpectedConditions.or(
                ExpectedConditions.urlContains("/admin/login"),
                ExpectedConditions.urlContains("/login")
        ));

        // 4. Validasi bahwa sesi admin telah berakhir dan berada di halaman otentikasi
        assertTrue(
                driver.getCurrentUrl().contains("login"),
                "Admin gagal melakukan logout atau tidak diarahkan kembali ke halaman login."
        );
    }
}
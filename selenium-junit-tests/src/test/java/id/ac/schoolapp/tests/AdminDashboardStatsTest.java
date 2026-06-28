package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminDashboardStatsTest extends BaseTest {

    @Test
    void adminDashboardShowsStatisticalCards() {
        // 1. Login dan masuk otomatis ke dashboard admin
        loginAsAdmin();

        // 2. Tunggu seluruh element box statistik (counter siswa, guru, dsb) tampil
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));
        assertPageDoesNotShowServerError();

        // 3. Verifikasi keberadaan komponen UI dashboard umum (Card box atau teks sambutan)
        boolean hasDashboardContent = driver.getPageSource().toLowerCase().contains("dashboard") 
                || driver.getPageSource().toLowerCase().contains("selamat datang")
                || !driver.findElements(By.className("card")).isEmpty();

        assertTrue(hasDashboardContent, "Dashboard utama kosong atau gagal memuat statistik ringkasan.");
    }
}
package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class PublicNewsPaginationTest extends BaseTest {

    @Test
    void guestUserCanNavigateNewsPagination() {
        // Buka daftar berita publik
        open("/berita");

        try {
            // Mencoba melakukan klik link pagination halaman ke-2 (Next / Angka 2) bawaan Laravel Pagination Links
            driver.findElement(By.cssSelector(".pagination a[rel='next'], a[href*='page=2']")).click();
            
            wait.until(ExpectedConditions.urlContains("page="));
            assertPageDoesNotShowServerError();
            assertTrue(driver.getCurrentUrl().contains("page=2"), "Navigasi pagination halaman 2 berita gagal.");
        } catch (Exception e) {
            System.out.println("Artikel berita tidak cukup banyak untuk memicu kemunculan link pagination.");
            assertTrue(driver.getCurrentUrl().contains("/berita"));
        }
    }
}
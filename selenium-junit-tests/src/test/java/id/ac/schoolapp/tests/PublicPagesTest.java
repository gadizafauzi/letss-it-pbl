package id.ac.schoolapp.tests;

import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.CsvSource;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class PublicPagesTest extends BaseTest {

    @ParameterizedTest(name = "Halaman publik {0} harus tampil")
    @CsvSource({
            "/,SIT",
            "/profil,Profil",
            "/unit/tk,TK",
            "/unit/sd,SD",
            "/unit/smp,SMP",
            "/ppdb,PPDB",
            "/berita,Berita"
    })
    void publicPagesShouldOpenWithoutServerError(String path, String expectedText) {
        open(path);

        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));

        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getPageSource().toLowerCase().contains(expectedText.toLowerCase()),
                "Halaman " + path + " tidak memuat teks yang diharapkan: " + expectedText
        );
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.CsvSource;
import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;

import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminContentAccessTest extends BaseTest {

    @ParameterizedTest(name = "Admin bisa membuka menu {1}")
    @CsvSource({
            "/admin/siswa,Siswa",
            "/admin/guru,Guru",
            "/admin/kelas,Kelas",
            "/admin/mapel,Mapel",
            "/admin/tahun-ajaran,Tahun Ajaran",
            "/admin/cms/beranda,CMS Beranda",
            "/admin/cms/profil,CMS Profil",
            "/admin/cms/ppdb,CMS PPDB",
            "/admin/cms/berita,Berita",
            "/admin/tagihan,Tagihan",
            "/admin/pembayaran,Pembayaran"
    })
    void adminCanOpenImportantAdminPages(String path, String featureName) {
        loginAsAdmin();

        open(path);
        wait.until(ExpectedConditions.presenceOfElementLocated(By.tagName("body")));

        assertPageDoesNotShowServerError();
        assertTrue(
                driver.getCurrentUrl().contains(path),
                "Admin tidak berada di halaman fitur: " + featureName
        );
    }
}

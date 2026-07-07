package id.ac.schoolapp.tests;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Admin - Other Features & CMS Tests")
public class AdminLainnyaTest extends BaseTest {

    @BeforeAll
    void setupAdmin() {
        loginAsAdmin();
    }

    @Test
    @DisplayName("Admin can access CMS and Master Data pages without server errors")
    void adminCanAccessOtherPages() {
        String[] pagesToTest = {
            "/admin/cms/beranda",
            "/admin/cms/kontak",
            "/admin/cms/ppdb",
            "/admin/cms/profil",
            "/admin/cms/unit",
            "/admin/berita",
            "/admin/agenda",
            "/admin/kategori-berita",
            "/admin/jabatan",
            "/admin/unit",
            "/admin/profil",
            "/admin/settings",
            "/admin/user", // user-management
            "/admin/kenaikan-kelas",
            "/admin/dashboard"
        };

        for (String page : pagesToTest) {
            open(page);
            assertPageDoesNotShowServerError();
            // Just basic validation that page doesn't crash
            assertTrue(!driver.getPageSource().isEmpty(), "Page " + page + " failed to load.");
        }
    }
}

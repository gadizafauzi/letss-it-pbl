package id.ac.schoolapp.tests;

import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import static org.junit.jupiter.api.Assertions.assertTrue;

class AdminAuthValidationTest extends BaseTest {

    @Test
    void adminLoginShouldRejectEmptyFields() {
        // 1. Buka Halaman Login Admin
        open("/admin/login");

        // 2. Langsung klik button login tanpa mengisi username maupun password
        waitVisible(By.id("adminBtn")).click();

        // 3. Sistem harus menahan authentikasi dan tetap berada di route login
        assertPageDoesNotShowServerError();
        
        assertTrue(
                driver.getCurrentUrl().contains("/admin/login"),
                "Sistem meloloskan form login kosong! Seharusnya tertahan di halaman login."
        );
    }
}
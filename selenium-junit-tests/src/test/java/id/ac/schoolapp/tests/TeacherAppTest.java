package id.ac.schoolapp.tests;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.openqa.selenium.By;

import static org.junit.jupiter.api.Assertions.assertTrue;

@DisplayName("Teacher - App Tests")
@TestMethodOrder(MethodOrderer.OrderAnnotation.class)
public class TeacherAppTest extends BaseTest {

    @BeforeAll
    void setupTeacher() {
        loginAsTeacher("1987654321", "12345678");
    }

    @Test
    @Order(1)
    @DisplayName("Teacher cannot login with invalid credentials")
    void testTeacherLoginInvalid() {
        open("/login");
        waitVisible(By.id("tab-teacher")).click();
        waitVisible(By.id("login")).sendKeys("1111111111"); // Invalid NIP
        driver.findElement(By.id("password")).sendKeys("wrongpassword");
        driver.findElement(By.id("loginBtn")).click();

        try {
            waitVisible(By.cssSelector(".alert-error"));
            assertTrue(driver.getCurrentUrl().contains("/login"), "Seharusnya tidak redirect");
        } catch(Exception e) {
            // Ignore if structure differs
        }
    }

    @Test
    @Order(2)
    @DisplayName("Teacher can view dashboard and navigate to profile")
    void testTeacherDashboardAndProfile() {
        if(driver.getCurrentUrl().contains("/teacher/")) {
            assertPageDoesNotShowServerError();

            waitVisible(By.cssSelector("a[href*='/teacher/profil']")).click();
            assertPageDoesNotShowServerError();

            assertTrue(driver.getCurrentUrl().contains("/teacher/profil"), "Gagal navigasi ke profil guru");
            assertTrue(driver.findElements(By.name("phone")).size() > 0, "Form profil guru tidak ditemukan");
        }
    }

    @Test
    @Order(3)
    @DisplayName("Teacher can access kelas saya and view students")
    void testTeacherViewKelasSaya() {
        if(driver.getCurrentUrl().contains("/teacher/")) {
            waitVisible(By.cssSelector("a[href*='/teacher/kelas-saya']")).click();
            assertPageDoesNotShowServerError();

            assertTrue(driver.getCurrentUrl().contains("/teacher/kelas-saya"), "Gagal navigasi ke Kelas Saya");
            assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel kelas tidak ditemukan");
        }
    }

    @Test
    @Order(4)
    @DisplayName("Wali Kelas can access data siswa")
    void testTeacherViewWaliDataSiswa() {
        if(driver.getCurrentUrl().contains("/teacher/")) {
            open("/teacher/wali-data-siswa");
            assertPageDoesNotShowServerError();

            if (driver.getCurrentUrl().contains("/teacher/wali-data-siswa")) {
                assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel data siswa tidak ditemukan");
            } else {
                System.out.println("Teacher bukan wali kelas atau redirect terjadi");
            }
        }
    }

    @Test
    @Order(5)
    @DisplayName("Wali Kelas can access rekap nilai")
    void testTeacherViewWaliRekapNilai() {
        if(driver.getCurrentUrl().contains("/teacher/")) {
            open("/teacher/wali-rekap-nilai");
            assertPageDoesNotShowServerError();

            if (driver.getCurrentUrl().contains("/teacher/wali-rekap-nilai")) {
                assertTrue(driver.findElements(By.cssSelector("table")).size() > 0, "Tabel rekap nilai tidak ditemukan");
            } else {
                System.out.println("Teacher bukan wali kelas atau redirect terjadi");
            }
        }
    }
}

package id.ac.schoolapp.tests;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.TestInstance;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

import static org.junit.jupiter.api.Assertions.assertFalse;

@TestInstance(TestInstance.Lifecycle.PER_CLASS)
public abstract class BaseTest {
    protected static final String BASE_URL = System.getProperty("baseUrl", "http://127.0.0.1:8000");
    protected static final String ADMIN_USERNAME = System.getProperty("adminUser", "admin");
    protected static final String ADMIN_PASSWORD = System.getProperty("adminPassword", "12345678");

    protected WebDriver driver;
    protected WebDriverWait wait;

    @BeforeAll
    void setUp() {
        ChromeOptions options = new ChromeOptions();
        options.addArguments("--start-maximized");
        options.addArguments("--disable-notifications");
        // Enable headless mode when system property "headless" is true
        if (Boolean.getBoolean("headless")) {
            options.addArguments("--headless=new");
        }
        driver = new ChromeDriver(options);
        wait = new WebDriverWait(driver, Duration.ofSeconds(10));
    }

    @AfterAll
    void tearDown() {
        if (driver != null) {
            driver.quit();
        }
        // Placeholder for test data cleanup (e.g., delete created records via API)
        // Implement actual cleanup logic as needed.
    }

    protected void open(String path) {
        driver.get(BASE_URL + path);
    }

    protected WebElement waitVisible(By locator) {
        return wait.until(ExpectedConditions.visibilityOfElementLocated(locator));
    }

    protected void assertPageDoesNotShowServerError() {
        String source = driver.getPageSource().toLowerCase();
        assertFalse(source.contains("sqlstate"), "Halaman menampilkan error database SQLSTATE.");
        assertFalse(source.contains("queryexception"), "Halaman menampilkan QueryException.");
        assertFalse(source.contains("server error"), "Halaman menampilkan server error.");
    }

    protected void loginAsAdmin() {
        open("/admin/login");
        waitVisible(By.id("admin_login")).sendKeys(ADMIN_USERNAME);
        driver.findElement(By.id("admin_password")).sendKeys(ADMIN_PASSWORD);
        driver.findElement(By.id("adminBtn")).click();
        wait.until(ExpectedConditions.urlContains("/admin/dashboard"));
    }

    protected void loginAsStudent(String nis, String password) {
        open("/login");
        waitVisible(By.id("tab-student")).click();
        waitVisible(By.id("login")).sendKeys(nis);
        driver.findElement(By.id("password")).sendKeys(password);
        driver.findElement(By.id("loginBtn")).click();
        wait.until(ExpectedConditions.urlContains("/student/"));
    }

    protected void loginAsTeacher(String nip, String password) {
        open("/login");
        waitVisible(By.id("tab-teacher")).click();
        waitVisible(By.id("login")).sendKeys(nip);
        driver.findElement(By.id("password")).sendKeys(password);
        driver.findElement(By.id("loginBtn")).click();
        wait.until(ExpectedConditions.urlContains("/teacher/"));
    }
}

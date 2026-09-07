import { Page, expect } from '@playwright/test';

export async function loginAs(page: Page, email: string, password: string) {
    await page.goto('/login');
    await page.waitForSelector('input[type="email"], input[name="email"], #email');

    const emailInput = page.locator('input[type="email"], input[name="email"], #email').first();
    const passwordInput = page.locator('input[type="password"], input[name="password"], #password').first();

    await emailInput.fill(email);
    await passwordInput.fill(password);

    const submitButton = page.locator('button[type="submit"]').first();
    await submitButton.click();

    await page.waitForURL((url) => !url.pathname.includes('/login'), { timeout: 10000 });
}

export async function loginAsSuperAdmin(page: Page) {
    await loginAs(page, 'admin@eduai.com', 'password');
}

export async function loginAsAdmin(page: Page) {
    await loginAs(page, 'accountadmin@eduai.com', 'password');
}

export async function loginAsTeacher(page: Page) {
    await loginAs(page, 'teacher@eduai.com', 'password');
}

export async function loginAsStudent(page: Page) {
    await loginAs(page, 'student@eduai.com', 'password');
}

export async function loginAsParent(page: Page) {
    await loginAs(page, 'parent@eduai.com', 'password');
}

export async function expectSidebarItem(page: Page, name: string, visible: boolean = true) {
    const item = page.locator(`nav a, aside nav a`).filter({ hasText: name });
    if (visible) {
        await expect(item.first()).toBeVisible();
    } else {
        await expect(item.first()).not.toBeVisible();
    }
}

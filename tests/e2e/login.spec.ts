import { test, expect } from '@playwright/test';
import { loginAsSuperAdmin, loginAsAdmin, expectSidebarItem } from './helpers/auth';

test.describe('Login', () => {
    test('login page loads correctly', async ({ page }) => {
        await page.goto('/login');
        await expect(page.locator('h1, h2, [class*="text-2xl"], [class*="text-xl"]').first()).toBeVisible();
        await expect(page.locator('input[type="email"], input[name="email"], #email').first()).toBeVisible();
        await expect(page.locator('input[type="password"], input[name="password"], #password').first()).toBeVisible();
        await expect(page.locator('button[type="submit"]').first()).toBeVisible();
    });

    test('super_admin logs in and sees superadmin sidebar', async ({ page }) => {
        await loginAsSuperAdmin(page);

        await expect(page.locator('text=Superadmin').first()).toBeVisible();
        await expectSidebarItem(page, 'Schools');
        await expectSidebarItem(page, 'Plans');
        await expectSidebarItem(page, 'Settings');
    });

    test('invalid login shows error', async ({ page }) => {
        await page.goto('/login');

        const emailInput = page.locator('input[type="email"], input[name="email"], #email').first();
        const passwordInput = page.locator('input[type="password"], input[name="password"], #password').first();

        await emailInput.fill('wrong@email.com');
        await passwordInput.fill('wrongpassword');
        await page.locator('button[type="submit"]').first().click();

        await expect(page.getByText('do not match').or(page.getByText('invalid')).or(page.getByText('incorrect')).or(page.locator('[class*="text-destructive"]').first())).toBeVisible({ timeout: 5000 });
    });

    test('admin logs in and sees admin sidebar', async ({ page }) => {
        await loginAsAdmin(page);

        await expect(page.locator('text=Account Admin').first()).toBeVisible();
        await expectSidebarItem(page, 'Students');
        await expectSidebarItem(page, 'Teachers');
        await expectSidebarItem(page, 'Classes');
    });
});

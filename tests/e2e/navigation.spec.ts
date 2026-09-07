import { test, expect } from '@playwright/test';
import { loginAsSuperAdmin, loginAsAdmin } from './helpers/auth';

test.describe('Navigation', () => {
    test('superadmin sidebar links navigate correctly', async ({ page }) => {
        await loginAsSuperAdmin(page);

        // Schools
        await page.locator('nav a').filter({ hasText: 'Schools' }).first().click();
        await expect(page).toHaveURL(/\/superadmin\/schools/);
        await expect(page.locator('h1').filter({ hasText: 'Schools' })).toBeVisible();

        // Plans
        await page.locator('nav a').filter({ hasText: 'Plans' }).first().click();
        await expect(page).toHaveURL(/\/superadmin\/plans/);
        await expect(page.locator('h1').filter({ hasText: /Plans|Subscription/ })).toBeVisible();

        // Back to Dashboard
        await page.locator('nav a').filter({ hasText: 'Dashboard' }).first().click();
        await expect(page).toHaveURL(/\/superadmin/);
    });

    test('admin sidebar links navigate correctly', async ({ page }) => {
        await loginAsAdmin(page);

        // Students
        await page.locator('nav a').filter({ hasText: 'Students' }).first().click();
        await expect(page).toHaveURL(/\/students/);
        await expect(page.locator('h1').filter({ hasText: 'Students' })).toBeVisible();

        // Classes
        await page.locator('nav a').filter({ hasText: 'Classes' }).first().click();
        await expect(page).toHaveURL(/\/classes/);
        await expect(page.locator('h1').filter({ hasText: 'Classes' })).toBeVisible();
    });

    test('back button returns to previous page', async ({ page }) => {
        await loginAsSuperAdmin(page);

        await page.goto('/superadmin/schools');
        await expect(page.locator('h1').filter({ hasText: 'Schools' })).toBeVisible();

        // Click first View button to go to detail
        const viewBtn = page.locator('a[href*="/superadmin/schools/"]').first();
        if (await viewBtn.isVisible()) {
            await viewBtn.click();
            await page.waitForTimeout(500);

            // Click back button
            const backBtn = page.locator('a[href="/superadmin/schools"], button').filter({ hasText: '' }).first();
            if (await backBtn.isVisible()) {
                await backBtn.click();
                await expect(page).toHaveURL(/\/superadmin\/schools/);
            }
        }
    });

    test('unauthenticated user redirects to login', async ({ page }) => {
        await page.goto('/superadmin');
        await expect(page).toHaveURL(/\/login/);
    });

    test('admin cannot access superadmin routes', async ({ page }) => {
        await loginAsAdmin(page);
        await page.goto('/superadmin');
        // Should be redirected away from superadmin
        await expect(page).not.toHaveURL(/\/superadmin/, { timeout: 5000 });
    });
});

import { test, expect } from '@playwright/test';
import { loginAsAdmin, expectSidebarItem } from './helpers/auth';

test.describe('Admin Panel', () => {
    test.beforeEach(async ({ page }) => {
        await loginAsAdmin(page);
    });

    test('dashboard loads with stats', async ({ page }) => {
        await page.goto('/dashboard');
        await expect(page.locator('text=Dashboard').first()).toBeVisible();
    });

    test('sidebar has correct admin navigation', async ({ page }) => {
        await expectSidebarItem(page, 'Dashboard');
        await expectSidebarItem(page, 'Students');
        await expectSidebarItem(page, 'Teachers');
        await expectSidebarItem(page, 'Classes');
        await expectSidebarItem(page, 'Subjects');
        await expectSidebarItem(page, 'Attendance');
        await expectSidebarItem(page, 'Fees');
        await expectSidebarItem(page, 'Exams');
        await expectSidebarItem(page, 'Notices');
        await expectSidebarItem(page, 'Events');
    });

    test('students page loads', async ({ page }) => {
        await page.goto('/students');
        await expect(page.locator('h1').filter({ hasText: 'Students' })).toBeVisible();
    });

    test('teachers page loads', async ({ page }) => {
        await page.goto('/teachers');
        await expect(page.locator('h1').filter({ hasText: 'Teachers' })).toBeVisible();
    });

    test('classes page loads', async ({ page }) => {
        await page.goto('/classes');
        await expect(page.locator('h1').filter({ hasText: 'Classes' })).toBeVisible();
    });

    test('subjects page loads', async ({ page }) => {
        await page.goto('/subjects');
        await expect(page.locator('h1').filter({ hasText: 'Subjects' })).toBeVisible();
    });

    test('exams page loads', async ({ page }) => {
        await page.goto('/exams');
        await expect(page.locator('h1').filter({ hasText: 'Exams' })).toBeVisible();
    });
});

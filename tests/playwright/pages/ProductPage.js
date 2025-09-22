import { expect } from '@playwright/test'

export class ProductPage {
    constructor(page) {
        this.page = page
    }

    async goto(url) {
        await this.page.goto(url)
        return await this.page.evaluate(() => window.config.product)
    }

    async getRatingText() {
        const ratingElement = await this.page.getByTestId('rating-number')
        return await ratingElement.textContent()
    }

    async hasReviews() {
        await expect(this.page.getByTestId('reviews')).toBeVisible()
        const reviewItems = await this.page.getByTestId('review-item').count()
        return reviewItems > 0
    }

    async writeReview() {
        await expect(this.page.getByTestId('reviews')).toBeVisible()
        await this.page.getByTestId('write-review-button').click()
        await this.page.getByTestId('star-rating').last().click()
        await this.page.fill('[name=nickname]', 'Bruce')
        await this.page.fill('[name=summary]', 'I love this jacket')
        await this.page.fill('[name=review]', 'The Typhon Performance Fleece-lined Jacket delivers unmatched comfort with its ultra-soft microfleece lining and sleek flatlock seams, making it perfect for layering in any situation. A solid 5/5 stars for style, versatility, and all-day warmth.')
        await this.page.getByTestId('submit-review').click()
        await this.page.waitForLoadState('networkidle')
        await expect(this.page.locator('text=You submitted your review for moderation.')).toBeVisible();
    }
}
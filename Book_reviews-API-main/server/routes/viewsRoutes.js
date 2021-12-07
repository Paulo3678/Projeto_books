const express = require('express')
const router = express.Router()
const ratBooksService = require('../service/viewsService')

// Get best 3 rating books
router.get('/ratingBooks', async (req, res, next) => {
	try {
		const books = await ratBooksService.getRatingBooks()
		res.status(200).json(books)
	} catch (e) {
		next(e)
	}
})

// Get more revieewd books
router.get('/moreReviewedBooks', async (req, res, next) => {
	try {
		const books = await ratBooksService.getReviewedBooks()
		res.status(200).json(books)
	} catch (e) {
		next(e)
	}
})

// Get last reviews
router.get('/lastReviews', async (req, res, next) => {
	try {
		const reviews = await ratBooksService.getLastReviews()
		res.status(200).json(reviews)
	} catch (e) {
		next(e)
	}
})

module.exports = router
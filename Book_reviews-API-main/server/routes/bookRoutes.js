const express = require('express')
const ensureAuthenticated = require('../middlewares/ensureAuthenticated')
const bookService = require('../service/bookService')

const router = express.Router()

// Create book
router.post('/books', ensureAuthenticated, async (req, res, next) => {
	const data = req.body
	try {
		if (req.usuario.admin !== true) throw new Error('Unauthorized')
		const newBook = await bookService.saveBook(data)
		res.status(201).json(newBook)
	} catch (e) {
		next(e)
	}
})

// Get book by id
router.get('/books/:id', async (req, res, next) => {
	try {
		const book = await bookService.getBook(req.params.id)
		res.status(200).json(book)
	} catch (e) {
		next(e)
	}
})

// Get book by title or author
router.get('/books/search/:titleOrAuthor', async (req, res, next) => {
	try {
		const book = await bookService.getBooks(req.params.titleOrAuthor)
		res.status(200).json(book)
	} catch (e) {
		next(e)
	}
})

// Update book
router.put('/books/:id', ensureAuthenticated, async (req, res, next) => {
	const newData = req.body
	try {
		if (req.usuario.admin !== true) throw new Error('Unauthorized')
		await bookService.putBook(req.params.id, newData)
		res.status(200).end()
	} catch (e) {
		next(e)
	}
})

// Delete book
router.delete('/books/:id', ensureAuthenticated, async (req, res, next) => {
	try {
		if (req.usuario.admin !== true) throw new Error('Unauthorized')
		await bookService.deleteBook(req.params.id)
		res.status(200).end()
	} catch (e) {
		next(e)
	}
})

module.exports = router

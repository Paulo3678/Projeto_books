const moment = require('moment')
const bookData = require('../data/bookData')
const authorData = require('../data/authorData')

exports.saveBook = async function (dataNewBook) {
	const existingBook = await bookData.getBookByIsbn(dataNewBook.isbn)
	if (existingBook) throw new Error('Book already exist')

	const { authors } = dataNewBook
	delete dataNewBook.authors
	dataNewBook.published_date = moment(new Date(dataNewBook.published_date), 'MM-DD-YYYY')
	const newBook = await bookData.saveBook(dataNewBook)

	const newAuthors = []
	for (let i = 0; i < authors.length; i += 1) {
		const author = authors[i]
		const newAuthor = await authorData.saveAuthor(author, newBook.id)
		newAuthors.push(newAuthor)
	}

	return { newBook, newAuthors }
}

exports.getBook = async function (id) {
	const book = await bookData.getBook(id)
	if (!book) throw new Error('Book not found')

	const authorsMetaData = await authorData.getAuthors(book.id)

	const authors = []
	for (let i = 0; i < authorsMetaData.length; i += 1) {
		authors.push(authorsMetaData[i].dataValues.name)
	}
	book.dataValues.authors = authors
	return book
}

exports.getBooks = async function (titleOrAuthor) {
	var books = await bookData.getBooks(titleOrAuthor)
	if (!books.length) throw new Error('Book not found')

	for (let i = 0; i < books.length; i += 1) {
		const authorsMetaData = await authorData.getAuthors(books[i].dataValues.id)

		const authors = []
		for (let j = 0; j < authorsMetaData.length; j += 1) {
			authors.push(authorsMetaData[j].dataValues.name)
		}
		books[i].dataValues.authors = authors
	}

	return books
}

exports.putBook = async function (id, newData) {
	const existingBook = await bookData.getBook(id)
	if (!existingBook) throw new Error('Book not found')

	if (Object.prototype.hasOwnProperty.call(newData, 'isbn')) {
		const existingBookIsbn = await bookData.getBookByIsbn(newData.isbn)
		if (existingBookIsbn) throw new Error('isbn already exist')
	}

	return bookData.putBook(id, newData)
}

exports.deleteBook = async function (id) {
	const existingBook = await bookData.getBook(id)
	if (!existingBook) throw new Error('Book not found')

	return bookData.deleteBook(id)
}

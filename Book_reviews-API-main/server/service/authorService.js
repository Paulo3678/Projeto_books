const authorData = require('../data/authorData')

exports.saveAuthor = async function (data) {
	const bookAuthors = await authorData.getAuthors(data.id_book)

	bookAuthors.forEach((author) => {
		if (author.name === data.name) throw new Error('Author already exist')
	})

	return authorData.saveAuthor(data.name, data.id_book)
}

exports.getAuthor = async function (idAuthor) {
	const author = await authorData.getAuthor(idAuthor)
	if (!author) throw new Error('Author not found')

	return author
}

exports.getAuthors = async function (idBook) {
	const authors = await authorData.getAuthors(idBook)
	if (!authors) throw new Error('Authors not found')

	return authors
}

exports.putAuthor = async function (id, newData) {
	const existingAuthor = await authorData.getAuthor(id)
	if (!existingAuthor) throw new Error('Author not found')

	return authorData.putAuthor(id, newData)
}

exports.deleteAuthor = async function (id) {
	const existingBook = await authorData.getAuthor(id)
	if (!existingBook) throw new Error('Author not found')

	return authorData.deleteAuthor(id)
}

const reviewData = require('../data/reviewData')
const userData = require('../data/userData')
const bookData = require('../data/bookData')

exports.saveReview = async function (data) {
	const existingUser = await userData.getUser(data.id_user)
	if (!existingUser) throw new Error('User not found')

	const existingBook = await bookData.getBook(data.id_book)
	if (!existingBook) throw new Error('Book not found')

	return reviewData.saveReview(data)
}
exports.getReview = async function (id) {
	const review = await reviewData.getReview(id)
	if (!review) throw new Error('Review not found')

	return review
}

exports.getUserReviews = async function (id) {
	const existingUser = await userData.getUser(id)
	if (!existingUser) throw new Error('User not found')

	const userReviews = await reviewData.getUserReviews(id)
	if (!userReviews.length) throw new Error('Reviews not found')

	return userReviews
}

exports.getBookReviews = async function (id) {
	const existingBook = await bookData.getBook(id)
	if (!existingBook) throw new Error('Book not found')

	const bookReviews = await reviewData.getBookReviews(id)
	if (!bookReviews.length) throw new Error('Reviews not found')

	return bookReviews
}

exports.putReview = async function (id, idUser, newData) {
	const existingReview = await reviewData.getReview(id)
	if (!existingReview) throw new Error('Review not found')

	if (existingReview.id_user !== idUser) throw new Error('Unauthorized')

	return reviewData.putReview(id, newData)
}

exports.deleteReview = async function (id, idUser) {
	const existingReview = await reviewData.getReview(id)
	if (!existingReview) throw new Error('Review not found')

	if (existingReview.id_user !== idUser) throw new Error('Unauthorized')

	return reviewData.deleteReview(id)
}

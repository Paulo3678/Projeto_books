const ratBooksData = require('../data/viewsData')

exports.getRatingBooks = () => {
    return ratBooksData.getRatingBooks()
}

exports.getReviewedBooks = () => {
    return ratBooksData.getReviewedBooks()
}

exports.getLastReviews = () => {
    return ratBooksData.getLastReviews()
}
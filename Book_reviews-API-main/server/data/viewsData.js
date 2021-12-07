const { Pool } = require('pg')
require('dotenv').config()


function connectDb () {
    const pool = new Pool({
        user: process.env.DB_USER,
        host: 'localhost',
        database: process.env.DB_DATABASE,
        password: process.env.DB_PASS,
      })
     
      return pool
}

exports.getRatingBooks = async () =>{
    const pool = connectDb()
    const { rows }  = await pool.query('SELECT * from best_3_rating_books')
    pool.end()
    
    return rows
}

exports.getReviewedBooks = async () =>{
    const pool = connectDb()
    const { rows }  = await pool.query('SELECT * from best_3_reviewed_books')
    pool.end()
    
    return rows
}

exports.getLastReviews = async () =>{
    const pool = connectDb()
    const { rows }  = await pool.query('SELECT * from last_3_reviews_posted')
    pool.end()
    
    return rows
}
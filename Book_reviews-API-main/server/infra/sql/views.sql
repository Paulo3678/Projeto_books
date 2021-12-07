-- View com os 3 livros mais bem avaliados
CREATE VIEW best_3_rating_books AS SELECT * FROM books ORDER BY rating DESC LIMIT 3;

-- View com os 3 livros que mais possuem reviews
CREATE VIEW best_3_reviewed_books AS SELECT * FROM books bks WHERE bks.id IN (SELECT id_book FROM reviews GROUP BY id_book ORDER BY count(*) DESC LIMIT 3);

-- View com as 3 últimas reviews postadas
CREATE VIEW last_3_reviews_posted AS SELECT * FROM reviews ORDER BY date DESC LIMIT 3;
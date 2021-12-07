const express = require('express')

const app = express()

app.use(express.json())
app.use('/', require('./routes/userRoutes'))
app.use('/', require('./routes/bookRoutes'))
app.use('/', require('./routes/reviewRoutes'))
app.use('/', require('./routes/authorRoutes'))
app.use('/', require('./routes/viewsRoutes'))
app.use(require('./middlewares/errors'))

app.listen(3000)

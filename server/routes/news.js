const express = require('express');
const multer = require('multer');
const path = require('path');
const db = require('../database');
const authMiddleware = require('../middleware/auth');

const router = express.Router();

const storage = multer.diskStorage({
  destination: (req, file, cb) => cb(null, 'uploads/'),
  filename: (req, file, cb) => {
    const uniqueName = Date.now() + '-' + Math.round(Math.random() * 1E9) + path.extname(file.originalname);
    cb(null, uniqueName);
  }
});
const upload = multer({ storage, limits: { fileSize: 5 * 1024 * 1024 } });

// Получить все новости
router.get('/', (req, res) => {
  db.all('SELECT * FROM news ORDER BY created_at DESC', [], (err, rows) => {
    if (err) return res.status(500).json({ error: 'Ошибка БД' });
    res.json(rows);
  });
});

// Создать новость
router.post('/', authMiddleware, upload.single('image'), (req, res) => {
  const { title, text, date } = req.body;
  const image = req.file ? `/uploads/${req.file.filename}` : null;

  if (!title || !text || !date) {
    return res.status(400).json({ error: 'Заполните все обязательные поля' });
  }

  db.run('INSERT INTO news (title, text, date, image) VALUES (?, ?, ?, ?)', [title, text, date, image], function(err) {
    if (err) return res.status(500).json({ error: 'Ошибка БД' });
    res.json({ id: this.lastID, title, text, date, image });
  });
});

// Удалить новость
router.delete('/:id', authMiddleware, (req, res) => {
  db.run('DELETE FROM news WHERE id = ?', [req.params.id], (err) => {
    if (err) return res.status(500).json({ error: 'Ошибка БД' });
    res.json({ message: 'Новость удалена' });
  });
});

module.exports = router;

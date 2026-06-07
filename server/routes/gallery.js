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

// Получить все фото
router.get('/', (req, res) => {
  db.all('SELECT * FROM gallery ORDER BY created_at DESC', [], (err, rows) => {
    if (err) return res.status(500).json({ error: 'Ошибка БД' });
    res.json(rows);
  });
});

// Добавить фото
router.post('/', authMiddleware, upload.single('image'), (req, res) => {
  const { caption } = req.body;
  const image = req.file ? `/uploads/${req.file.filename}` : null;

  if (!image) {
    return res.status(400).json({ error: 'Загрузите изображение' });
  }

  db.run('INSERT INTO gallery (image, caption) VALUES (?, ?)', [image, caption || ''], function(err) {
    if (err) return res.status(500).json({ error: 'Ошибка БД' });
    res.json({ id: this.lastID, image, caption });
  });
});

// Удалить фото
router.delete('/:id', authMiddleware, (req, res) => {
  db.run('DELETE FROM gallery WHERE id = ?', [req.params.id], (err) => {
    if (err) return res.status(500).json({ error: 'Ошибка БД' });
    res.json({ message: 'Фото удалено' });
  });
});

module.exports = router;

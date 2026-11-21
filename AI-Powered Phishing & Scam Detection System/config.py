import os
import pymysql
import sqlite3

MYSQL_HOST = os.environ.get("DB_HOST", "localhost")
MYSQL_USER = os.environ.get("DB_USER", "root")
MYSQL_PASS = os.environ.get("DB_PASS", "username@2811")
MYSQL_NAME = os.environ.get("DB_NAME", "phishing_db")

SQLITE_DB_PATH = os.path.join(os.path.dirname(__file__), "phishing_app.db")


class SQLiteDictCursor:
    """Wrapper around sqlite3 cursor to mimic PyMySQL DictCursor with %s formatting."""
    def __init__(self, cursor):
        self.cursor = cursor

    def execute(self, query, params=None):
        sqlite_query = query.replace("%s", "?")
        if params is None:
            return self.cursor.execute(sqlite_query)
        return self.cursor.execute(sqlite_query, params)

    def fetchone(self):
        row = self.cursor.fetchone()
        if row is None:
            return None
        return dict(row)

    def fetchall(self):
        rows = self.cursor.fetchall()
        return [dict(r) for r in rows]

    def close(self):
        self.cursor.close()

    @property
    def lastrowid(self):
        return self.cursor.lastrowid

    @property
    def rowcount(self):
        return self.cursor.rowcount


class SQLiteConnWrapper:
    """Connection wrapper ensuring PyMySQL-compatible behavior and dict results."""
    def __init__(self, conn):
        self.conn = conn

    def cursor(self):
        cur = self.conn.cursor()
        return SQLiteDictCursor(cur)

    def commit(self):
        self.conn.commit()

    def rollback(self):
        self.conn.rollback()

    def close(self):
        self.conn.close()


def _init_sqlite_tables(conn):
    cur = conn.cursor()
    cur.execute("""
        CREATE TABLE IF NOT EXISTS users (
            user_id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            email TEXT
        )
    """)
    cur.execute("""
        CREATE TABLE IF NOT EXISTS history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            result TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
        )
    """)
    conn.commit()
    cur.close()


def get_db_connection():
    """Tries MySQL first; seamlessly falls back to SQLite if MySQL is unavailable."""
    try:
        conn = pymysql.connect(
            host=MYSQL_HOST,
            user=MYSQL_USER,
            password=MYSQL_PASS,
            database=MYSQL_NAME,
            cursorclass=pymysql.cursors.DictCursor
        )
        return conn
    except Exception:
        # Fallback to local SQLite database so CRUD and auth always work without interruption
        conn = sqlite3.connect(SQLITE_DB_PATH)
        conn.row_factory = sqlite3.Row
        _init_sqlite_tables(conn)
        return SQLiteConnWrapper(conn)


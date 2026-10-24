import os
import pymysql
import pymysql.cursors

def get_db_connection():
    return pymysql.connect(
        host=os.getenv("DB_HOST", "localhost"),
        user=os.getenv("DB_USER", "root"),
        password=os.getenv("DB_PASSWORD", "WJ28@ayus"),
        database=os.getenv("DB_NAME", "phishing_db"),
        cursorclass=pymysql.cursors.DictCursor
    )
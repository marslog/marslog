# backend/app.py
from flask import Flask
app = Flask(__name__)

@app.route('/')
def index():
    return 'MARSLOG API Running ✅'

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)

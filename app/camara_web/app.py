from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

if __name__ == '__main__':
    # Using adhoc SSL context so mobile browsers allow getUserMedia over HTTPS
    app.run(host='0.0.0.0', port=5000, ssl_context='adhoc', debug=True)

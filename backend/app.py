
from flask import Flask, jsonify

app = Flask(__name__)

@app.route('/api/devices_status')
def devices_status():
    return jsonify({
        "success": True,
        "devices": [
            {"name": "Router01", "status": "Online", "CPU Usage": 23, "Memory Usage": 54},
            {"name": "Firewall01", "status": "Offline", "CPU Usage": 0, "Memory Usage": 0}
        ]
    })

@app.route('/api/logs')
def logs():
    return jsonify({
        "success": True,
        "logs": [
            {"timestamp": "2025-06-01T20:00:00Z", "message": "User login success"},
            {"timestamp": "2025-06-01T20:05:00Z", "message": "SNMP check failed"}
        ]
    })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)

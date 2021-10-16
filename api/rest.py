import json 
import pymysql
from app import app
from db import mysql
from flask import jsonify, request
from flask_cors import CORS, cross_origin

CORS(app, origins=['*'])
app.config['CORS_HEADERS'] = 'application/json'


@app.route('/api/getData', methods=['GET'])
def users():
       
    conn = mysql.connect()

    cursor = conn.cursor(pymysql.cursors.DictCursor)
    cursor.execute("SELECT * FROM user")

    rows = cursor.fetchall()

    resp = jsonify(rows)
    resp.status_code = 200

    return resp

@app.route('/api/addData', methods=['POST', 'OPTIONS'])
@cross_origin()
def insert_users():

    if request.method == "POST":
        details = request.json

        if details['inseU'] == 1:

            conn = mysql.connect()
            cursor = conn.cursor()
            
            jsonObject = json.loads(details['idata'])

            for index,item in enumerate(jsonObject):
                
                
                cursor.execute("INSERT  INTO `user`(`name`,`email`,`phone`,`address`,`nacionality`) VALUES ('%s','%s','%s','%s','%s')"%(item["name"],item["email"],item["phone"],item["address"],item["nacionality"]))
                conn.commit()         

            resp = jsonify('success add users')
            resp.status_code = 200
            
        else:
            resp = jsonify('error')
            resp.status_code = 200
    else:
        resp = jsonify('error')
        resp.status_code = 200

    return resp

@app.route('/api/deleteData', methods=['POST', 'OPTIONS'])
@cross_origin()
def delete_users():

    if request.method == "POST":
        details = request.json
        

        if details['dropU'] == 1:

            conn = mysql.connect()
            cursor = conn.cursor()
            cursor.execute("DELETE FROM `user` WHERE 1")
            conn.commit()
            
            resp = jsonify('success drop user')
            resp.status_code = 200
        else:
            resp = jsonify('error')
            resp.status_code = 200
    else:
        resp = jsonify('error')
        resp.status_code = 200

    return resp



if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=80)

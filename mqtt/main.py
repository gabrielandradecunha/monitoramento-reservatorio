import paho.mqtt.client as mqtt
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
import json
import os
from dotenv import load_dotenv
from database import update_db, get_mac
from router import router
from datetime import datetime
import threading

load_dotenv()

# mosquitto credentials
user = os.getenv('MOSQUITTO_USER')
password = os.getenv('MOSQUITTO_PASSWORD')
mqtt_host = os.getenv('MOSQUITTO_HOST')
mqtt_port = os.getenv('MOSQUITTO_PORT')
mqtt_topic = os.getenv('MOSQUITTO_TOPIC')

# API
# frontend url for cors
url_frontend = os.getenv('URL_FRONTEND')

app = FastAPI()

origins = [
    str(url_frontend),
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://127.0.0.1:8000"], # porta da aplicação php
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

app.include_router(router, tags=[""])

@app.get("/")
def root():
    return {"message": "API to connect in broker mqtt"}

# MQTT callback's
def on_connect(client, userdata, flags, reason_code, properties):
    print(f"MQTT broker conected with result code: {reason_code}")
    client.subscribe(mqtt_topic)
    print(f"MAC's in database: {get_mac()}")

def on_disconnect(client, userdata, rc):
    print("MQTT broker disconnected with result code: %s", rc)

def on_message(client, userdata, msg):
    print(f"Topic: {msg.topic}")

    json_string = msg.payload
    data = json.loads(json_string)

    # valor do hidrometro mudar no codigo
    litros = 10

    date_time = datetime.utcfromtimestamp(data['mem']['epoch'])

    print(
        f"devid: {data['devid']}, "
        f"volume: {int(data['mem']['in1_cnt_pulses']) * litros}, "
        f"umidade: {int(data['mem']['var0']) / 10}, "
        f"temperatura: {int(data['mem']['var1']) / 10}, "
        f"timestamp: {date_time.strftime('%Y-%m-%d %H:%M:%S')}"
    )


    update_db(str(data['devid']), int(data['mem']['in1_cnt_pulses']*litros), '0', '0')
    #data['longitude'], data['latitude']

client = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)
# caso nao usar broker publico
#client.username_pw_set(user, password)
client.connect(str(mqtt_host), int(mqtt_port), 60)

# tls opcional
#client.tls_set()

client.on_connect = on_connect
client.on_message = on_message

def run_mqtt():
    client.loop_forever()

mqtt_thread = threading.Thread(target=run_mqtt)
mqtt_thread.daemon = True
mqtt_thread.start()
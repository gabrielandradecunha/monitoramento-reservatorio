import paho.mqtt.client as mqtt
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
import json
import os
from dotenv import load_dotenv
from database import update_db, get_mac
from router import router

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
    allow_origins=["*"], # aceita todas as origens para testes
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

    print(f"mac: {data['MACAddress']}, volume: {data['Nivel_agua']}, longitude: {data['longitude']}, latitude: {data['latitude']}")

    update_db(data['MACAddress'], data['Nivel_agua'], data['longitude'], data['latitude'])

mqttc = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)

# optional tls
#mqttc.tls_set()

# user and password for priate brokers
mqttc.username_pw_set(user, password)
mqttc.connect(str(mqtt_host), int(mqtt_port), 60)

mqttc.on_connect = on_connect
mqttc.on_message = on_message

mqttc.loop_forever()

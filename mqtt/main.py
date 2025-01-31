import paho.mqtt.client as mqtt
import json
import os
from dotenv import load_dotenv
from database import update_db

load_dotenv()

user = os.getenv('MOSQUITTO_USER')
password = os.getenv('MOSQUITTO_PASSWORD')
mqtt_host = os.getenv('MOSQUITTO_HOST')
mqtt_port = os.getenv('MOSQUITTO_PORT')
mqtt_topic = os.getenv('MOSQUITTO_TOPIC')

# MQTT
def on_connect(client, userdata, flags, reason_code, properties):
    print(f"Conected with result code: {reason_code}")
    client.subscribe(mqtt_topic)

def on_disconnect(client, userdata, rc):
    print("Disconnected with result code: %s", rc)

def on_message(client, userdata, msg):
    print(f"Tópico: {msg.topic}")

    json_string = msg.payload
    data = json.loads(json_string)

    print(f"id: {data['id']} e volume: {data['volume']}")

    update_db(data['id'], data['volume'])

mqttc = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)

# setando tls
#mqttc.tls_set()

mqttc.username_pw_set(user, password)
mqttc.connect(str(mqtt_host), int(mqtt_port), 60)

mqttc.on_connect = on_connect
mqttc.on_message = on_message

mqttc.loop_forever()

import paho.mqtt.client as mqtt
from fastapi import APIRouter, Form


router = APIRouter()

def ligarmotor(topic):
    client.publish(str(topic), '{"motor":"on"}')

# @router.post('/statusmotor')
# def statusmotor():


@router.post('/ligarmotor')
def motor():
    ligarmotor(f"{mqtt_topic}/motor")

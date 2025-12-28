import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522

GPIO.setwarnings(True)

reader = SimpleMFRC522()

try:
    print("Attente de la lecture du badge RFID...")
    badge_id = None
    while True:
        id, text = reader.read()
        if id:
            badge_id = id
            print("Badge RFID détecté !")
            print("ID du badge : {}".format(badge_id))
            print("Contenu du badge : {}".format(text))
            
            break
finally:
    GPIO.cleanup()

# Utilisation de l'ID du badge après la fin de la boucle
if badge_id:
    print("ID du badge détecté : {}".format(badge_id))
   print(badge_id)
else:
    print("Aucun badge détecté.")

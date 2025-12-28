
import time




try:
    start_time = time.time()
    badge_id = None
    while True:
        id = False
        if id:
            badge_id = id
            break
        elif time.time() - start_time > 5:
            break
        time.sleep(1)  # Attente de 0.1 seconde entre chaque itération
finally:
 print("ALLEZ")

# Utilisation de l'ID du badge après la fin de la boucle
if badge_id:
    print(badge_id)
else:
    print("error")

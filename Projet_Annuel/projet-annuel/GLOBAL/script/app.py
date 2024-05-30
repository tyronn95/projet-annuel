from flask import Flask, render_template, request
import googlemaps

app = Flask(__name__)
gmaps = googlemaps.Client(key='AIzaSyBCrq8GttmlC9YJP2mvk2TIXq1G_T_0L10')

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        adresse_depart = request.form['adresse_depart']
        print("Adresse de départ :", adresse_depart)
        adresse_arrivee = '4 Rue des Champs Guillaume, Cormeilles-en-Parisis, France'  # Remplacez par votre adresse d'arrivée
        distance_matrix = gmaps.distance_matrix(adresse_depart, adresse_arrivee)
        # Récupérer les données pertinentes de la matrice de distance ici
        prix = distance_matrix['rows'][0]['elements'][0]['distance']['value'] * 0.5
        print('hello')
        return render_template('result.html', distance_matrix=distance_matrix)
    return render_template('index.html')

if __name__ == '__main__':
    app.run(debug=True)

#48 Rue des Frères François, Conflans-Sainte-Honorine, France"
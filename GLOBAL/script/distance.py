from flask import Flask, render_template, request
import googlemaps

app = Flask(__name__)
gmaps = googlemaps.Client(key='api_key')

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        adresse_depart = request.form['adresse_depart']
        adresse_arrivee = "Argenteuil, France" 
        distance_matrix = gmaps.distance_matrix(adresse_depart, adresse_arrivee)
        return render_template('result.html', distance_matrix=distance_matrix)
    return render_template('services.php')

if __name__ == '__main__':
    app.run(debug=True)
#4 Rue des Champs Guillaume, Cormeilles-en-Parisis, France

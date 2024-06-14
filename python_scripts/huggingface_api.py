import requests

# Remplacez par votre clé API de Hugging Face
api_key = "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"

# URL de l'API pour GPT-J-6B
api_url = "https://api-inference.huggingface.co/models/EleutherAI/gpt-j-6B"

# En-têtes de la requête
headers = {
    "Authorization": f"Bearer {api_key}",
    "Content-Type": "application/json"
}

# Fonction pour interroger le mod   èle
def query(payload):
    response = requests.post(api_url, headers=headers, json=payload)
    return response.json()

# Exemple d'utilisation
data = query({
    "inputs": "What is the capital of France?"
})

print(data)

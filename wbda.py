from pinecone import Pinecone

# Con tu API Key de Pinecone
pc = Pinecone(api_key="pcsk_2R3dBF_TbtqPdrUB58o6n3xCMoGyboHEYsk2N4ppXAFjoT6a9MvWh35UQLmvEhqchJDGrk")

# Listar índices
indexes = pc.list_indexes()
print("Índices disponibles:", indexes)
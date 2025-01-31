import psycopg2
import os
from dotenv import load_dotenv

load_dotenv()

def update_db(table_id, new_vol):
    dbname = os.getenv('DB_NAME')
    db_user = os.getenv('DB_USER')
    password = os.getenv('DB_PASSWORD')
    host = os.getenv('DB_HOST')
    port = os.getenv('DB_PORT')

    database_url = f"postgresql://{db_user}:{password}@{host}:{port}/{dbname}"

    try:
        connection = psycopg2.connect(database_url)
        print("Conexão com DB estabelecida...")
    except psycopg2.Error as e:
        print(f"Erro ao conectar ao banco de dados: {e}")
        return

    cursor = connection.cursor()
    query = "UPDATE reservatorios SET volume_atual=%s WHERE id=%s"

    try:
        cursor.execute(query, (new_vol, table_id))
        connection.commit()
        if cursor.rowcount > 0:
            print(f"Volume atualizado com sucesso para o reservatório {table_id}. Novo volume: {new_vol}")
        else:
            print(f"Nenhum reservatório encontrado com o ID {table_id}. Nenhuma atualização realizada.")
    except Exception as e:
        print(f"Erro ao atualizar o banco de dados: {e}")
        connection.rollback()
    finally:
        cursor.close()
        if connection:
            connection.close()

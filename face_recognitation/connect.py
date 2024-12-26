import pyodbc

class DatabaseConnection:
    hostname ="DESKTOP-L28E7KG"
    database = "gym"
    username = "php"
    password = "php1"
    def create_connection():
        """Create and return a connection to the database."""
        try:
            connection = pyodbc.connect(
                f"DRIVER={{SQL Server}};"
                f"SERVER={DatabaseConnection.hostname};"
                f"DATABASE={DatabaseConnection.database};"
                f"UID={DatabaseConnection.username};"
                f"PWD={DatabaseConnection.password}"
            )
            print("Connection to SQL Server database was successful!")
            return connection
        except Exception as e:
            print("Error connecting to the database:", str(e))
            return None


connection = DatabaseConnection.create_connection()
cursor = connection.cursor()
cursor.execute("{CALL searchClientsMonthExpired(?)}", (1117,))
rows=cursor.fetchall()
print(rows)


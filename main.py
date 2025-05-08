from fastapi import FastAPI
from users.views import router as user_router

app = FastAPI()

# Registrar las rutas de usuarios
app.include_router(user_router, prefix="/api")

print(app.routes)

@app.get("/")
def root():
    return {"mensaje": "Bienvenido a EmprendeYa Backend"}

from supabase import create_client, Client
from .supabase_config import SUPABASE_URL, SUPABASE_API_KEY


def init_supabase_client() -> Client:
    supabase = create_client(SUPABASE_URL, SUPABASE_API_KEY)
    return supabase

# Example usage:
# supabase = init_supabase_client()
# response = supabase.from('your_table').select('*').execute()
# print(response.data)
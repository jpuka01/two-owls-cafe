import json

# Load JSON file
with open("C:/Users/johnp/OneDrive/Desktop/CS20/HW12/menu.json", "r", encoding="utf-8") as file:
    menu = json.load(file)

# Map product names to image file names
image_map = {
    "Cheeseburger🍔": "cheeseburger.jpg",
    "Club Sandwich🥪": "club_sandwich.jpg",
    "Fish & Chips🐟": "fishnchips.jpg",
    "Homemade Fries🍟": "fries.jpg",
    "Kale Salad🥗": "kale_salad.jpg",
    "Freshly Baked Cookies🍪": "cookies.jpg",
}

# SQL statements
sql_statements = []
for item in menu:
    name = item["name"].replace("'", "''")
    description = item["description"].replace("'", "''")
    price = float(item["price"].strip("$"))
    image = image_map.get(name, "default.jpg")

    sql_statements.append(
        f"INSERT INTO menu (name, description, price, image) "
        f"VALUES ('{name}', '{description}', {price}, '{image}');"
    )

# Write SQL statements to file
with open("C:/Users/johnp/OneDrive/Desktop/CS20/HW12/menu.sql", "w", encoding="utf-8") as sql_file:
    sql_file.write("\n".join(sql_statements))

print("SQL statements written to menu.sql")